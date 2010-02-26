<?php

/**
 * Use Markdown Markup in PmWiki
 * 
 * @author Sebastian Siedentopf <schlaefer@macnews.de>
 * @version 0.1
 * @link http://www.pmwiki.org/wiki/Cookbook/MarkdownMarkupExtension http://www.pmwiki.org/wiki/Cookbook/MarkdownMarkupExtension
 * @copyright by the respective authors 2006
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package markdownpmw
 */

define(MARKDOWNPMW, "0.1");

SDVA($PmWikiAutoUpdate['MarkdownPmW'], array(
    'version' => MARKDOWNPMW, 
    'updateurl' => 'http://www.pmwiki.org/wiki/Cookbook/MarkdownMarkupExtension',
));

include_once("markdown.php");

Markup("markdown", '<include', "/\(:markdown:\)(.*?)[\n]?\(:markdownend:\)/se", 
    "Keep(MarkupPmWikiConversion(PSS('$1')))");

function MarkupPmWikiConversion($text){
    $astr = array (
            "<:vspace>" => "\n\n",
            "(:nl:)" => "\n",
        );
    $pstr = array(
            "/<p>/" => "<p class='vspace'>",
            "/&amp;(.*?);/" => "&\\1;",
        );
        
    $text = str_replace(array_keys($astr), $astr, $text); 
    $text = Markdown($text);
    $text = preg_replace(array_keys($pstr), $pstr, $text); 
        
    return $text;
    }

?>