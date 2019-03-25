<?php
include_once('simple_html_dom.php');

function scraping_generic($url, $search) {
	// Didn't find it yet.
	$return = false;

	echo "reading the url: " . $url . "<br/>";
    // create HTML DOM
    $html = file_get_html($url);
	echo "url has been read.<br/>";

    // get article block
    foreach($html->find($search) as $found) {
		// Found at least one.
		$return = true;
		echo "found a: " . $search . "<br/><pre>";
		$found->dump();
		echo "</pre><br/>";
    echo $found;
    }
    
    // clean up memory
    $html->clear();
    unset($html);

    return $return;
}


// ------------------------------------------
error_log ("post:" . print_r($_GET, true));
$url = "";
if (isset($_GET['url']))
{
	$url = $_GET['url'];
}
$search = "";
if (isset($_GET['search']))
{
	$search = $_GET['search'];
}
?>
<form method="get">
	URL: <input name="url" type="text" value="<?=$url;?>" size="150"/><br/>
	Search: <input name="search" type="text" value="<?=$search;?>" size="150"/><br/>
	<input name="submit" type="submit" value="Submit"/>
</form>
<?php
// -----------------------------------------------------------------------------
// test it!
if (isset ($_GET['submit']))
{
	$response = scraping_generic($_GET['url'], $_GET['search']);
	if (!$response)
	{
		echo "Did not find any: " . $_GET['search'] . "<br />";
	}
}
?>