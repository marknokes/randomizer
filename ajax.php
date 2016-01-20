<?php

class StatementRandomizer
{
	public $statements;

	public function __construct()
	{
		$this->num = (int)$_GET['num'];

		$this->file_url = !empty( $_GET['fileUrl'] ) ? $_GET['fileUrl'] : false;

		$this->set_content();

		$this->set_statements();
	}

	private function set_statements()
	{
		if ( empty( $this->contents ) )
			$this->statements = json_encode( array( "No data" ) );
		else
			$this->statements = $this->get_rand();

		return;
	}

	private function set_content()
	{
		if ( false === $this->file_url )
			return "";
	    $ch = curl_init();

	    curl_setopt( $ch, CURLOPT_URL, $this->file_url );

	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	    $output = curl_exec($ch);

	    curl_close($ch);

	    $this->contents = $output;

	    return;
	}

	private function process_shortcodes( $item )
	{
		preg_match('/\[(.*)\]/', $item, $matches);

		if ( !$matches )
			return $item;
		
		$parts = explode( " ", $matches[1] );

		$target = end( $parts ) === '_blank' ? array_pop( $parts ) : '_parent';

		$link = array_pop( $parts );
		
		$text = implode( $parts, " " );
		
		$link = sprintf( '<a href="%s" target="%s">%s</a>', $link, $target, $text );

		return str_replace( $matches[0], $link, $item );
	}

	private function get_rand()
	{
		$return = array();

		$array = explode( "\n", $this->contents );

		$num_items = sizeof( $array );

		if ( $num_items === 1 || $this->num === 1 )
		{
			$rand_key = rand( 0, $num_items - 1 );

			$return[] = $this->process_shortcodes( $array[ $rand_key ] );
		}
		else
		{
			$rand = $this->num >= $num_items ? array_rand( $array, $num_items ) : array_rand( $array, $this->num );

			foreach( $rand as $key => $array_key )
			{
				if ( !empty( $array[ $array_key ] ) )
					$return[] = $this->process_shortcodes( $array[ $array_key ] );
			}
		}

		return json_encode( $return );
	}
}

$StatementRandomizer = new StatementRandomizer();

echo $StatementRandomizer->statements;

die();
