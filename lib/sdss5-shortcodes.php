<?php
function parse_sdss_publications() {
#    echo PATH_JSON;
    $publications_data_json = @file_get_contents(  PATH_JSON . 'publications.json' );
    $publications_data = json_decode( $publications_data_json, true );##

    echo "<ul class='fa-ul'>";
    foreach ($publications_data['publications'] as $this_pub): #( $publications_data['publications'] as $this_pub ) :  
        $dflt_url = ( !empty( $this_pub[ 'adsabs_url' ] ) ) ? $this_pub[ 'adsabs_url' ] : 
                        (( !empty( $this_pub[ 'doi_url' ] ) ) ? $this_pub[ 'doi_url' ] : 
    					(( !empty( $this_pub[ 'arxiv_url' ] ) ) ? $this_pub[ 'arxiv_url' ] : false )
                    );
        #echo "<li>". $dflt_url."</li>";
        echo "<li><i class='fa-li fa fa-book'></i>";
        if ( $dflt_url ) echo "<a target='_blank' href='$dflt_url' >";
        echo "<strong>" . $this_pub[ 'title' ] . "</strong>";
        if ( $dflt_url ) echo "</a>";
        echo '<br />' . $this_pub[ 'authors' ] .  '. ' ;
        echo "</li>";
        if ( $this_pub[ 'journal_reference' ]) {
			        echo $this_pub[ 'journal_reference' ];
		        } else {
			        echo '<em>' . $this_pub[ 'status' ] . '</em>';
		        }
        if ( !empty($this_pub[ 'adsabs' ] ) ) echo "; <a href='" . $this_pub[ 'adsabs_url' ] . "' target='_blank'>adsabs:" . $this_pub[ 'adsabs' ] . "</a>";
        if ( !empty($this_pub[ 'doi' ] ))  echo "; <a href='" . $this_pub[ 'doi_url' ] . "' target='_blank'>doi:" . $this_pub[ 'doi' ] . "</a>";
        if ( !empty($this_pub[ 'arxiv_url' ] ) ) echo "; <a href='" . $this_pub[ 'arxiv_url' ] . "' target='_blank'>arXiv:" . $this_pub[ 'arxiv' ] . "</a>";
        echo '</li>';
    endforeach;
    echo "</ul>";
    echo "<p>Last modified: ".$publications_data['modified']."</p>";
}

add_shortcode( 'SDSS_PUBLICATIONS', 'parse_sdss_publications' );
?>