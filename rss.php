<?php
header ( "Content-Type : application/rss+xml ; charset=utf-8" );

function get_rss ( $url ) {
	$xmlDoc = new DOMDocument ();
	$xmlDoc -> load ( $url );
	$articles = array ();
	$nodelist = $xmlDoc -> getElementsByTagName ( 'item' );
	foreach ( $nodelist as $item ) {
		$article = array ();
		$article["title"] = $item -> getElementsByTagName ( 'title' ) -> item ( 0 ) -> childNodes -> item ( 0 ) -> nodeValue;
		$article["link"] = $item -> getElementsByTagName ( 'link' ) -> item ( 0 ) -> childNodes -> item ( 0 ) -> nodeValue;
		$childNodes = $item -> getElementsByTagName ( 'description' ) -> item ( 0 ) -> childNodes;
		if ( $childNodes -> length > 0 ) {
			$article["descriptio"] = $childNodes -> item ( 0 ) -> nodeValue;
		}
		$articles[] = $article;
	}
	return $articles;
}	
	
	$articles = get_rss ( "http://www.hani.co.kr/rss/lead/" );
	$articles = array_merge ( $articles, get_rss ( "http://rss.ohmynews.com/rss/tom.xml" ) );
	$articles = araay_merge ( $articles, get_rss ( "http://myhome.chosun.com/rss/www_section_rss.xml" ) );
?>

<?xml version = "1.0" encoding = "UTF-8" ?>
<rss version "2.0">
	<channel>
		<title> RSS News Aggregator </title>
		<link> http://tahiti.mju.ac.kr </link>
		<description> 뉴스 통합 예제 </description>
		<language> ko </language>
		<pubDate> <?php echo date ( DATE_RFC822 ) ?> </pubDate>
		<generator> PHP/XML </generator>
		<managingEditor> Dongseop Kwon </managingEditor>
	<?php
		foreach ( $articles as $item ) {
			echo << EOT
				<item>
					<title> <![CDATA[{$item['title']}]]> </title>
					<link> <![CDATA[{$item['link']}]]> </link>
					<description> <!CDATA[{$item['description']}]] </description>
					<guid> <![CDATA[http://tahiti.mju.ac.kr?url = {$item['link']}]]> </guid>
				</item>
			EOT;
		}
	?>
	</channel>
</rss>
