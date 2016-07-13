<?='<?xml version="1.0" encoding="'.$charset.'"?>' . ""?>
<rss version="2.0"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:admin="http://webns.net/mvcb/"
	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
	xmlns:content="http://purl.org/rss/1.0/modules/content/">
		
	<channel>		
		<title><?=$feed_name?></title>
		<link><?=$feed_url?></link>
		<description><?=$page_description?></description>
		<dc:language><?=$page_language?></dc:language>
		<dc:creator><?=$creator_email?></dc:creator>
		<dc:rights>Copyright <?=gmdate("Y", time())?></dc:rights>
		<admin:generatorAgent rdf:resource="http://www.codeigniter.com/" />
		
		<?php foreach($entries as $entry): ?>
		<item>			
			<title><?=xml_convert($entry->name)?> No. <?=xml_convert($entry->title)?> Tahun <?=xml_convert($entry->regyear)?></title>
			<link><?=site_url('listings/details/'.$entry->entry_id)?></link>
			<guid><?=site_url('listings/details/'.$entry->entry_id)?></guid>			
			<description>
			<![CDATA[
				<?=$entry->description?>
			]]>
			</description>
			<?php $unix_date = strtotime($entry->date_added." GMT")?>
			<pubDate><?=date('r', $unix_date)?></pubDate>
		</item>
		<?php endforeach ?>
	</channel>
</rss>