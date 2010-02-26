<?php if (!defined('PmWiki')) exit();
/* PmWiki Equilibrium skin
 *
 * Examples at: http://pmwiki.com/Cookbook/Equilibrium and http://solidgone.org/Skins/
 * Copyright (c) 2009 David Gilbert
 * This work is licensed under a Creative Commons Attribution-Share Alike 3.0 United States License.
 * Please retain the links in the footer.
 * http://creativecommons.org/licenses/by-sa/3.0/us/
 */
global $FmtPV,$HTMLStylesFmt,$MarkupExpr;
$FmtPV['$SkinName'] = '"Equilibrium"';
$FmtPV['$SkinVersion'] = '"1.1.1"';
$FmtPV['$SkinDate'] = '"20091019"';

$MarkupExpr['mod'] = '($args[0] % $args[1])';

# Default color scheme
global $SkinColor, $ValidSkinColors;
$UserSkinColors = (is_array($ValidSkinColors) ?$ValidSkinColors :array());
$ValidSkinColors['black'] = array('block-highlight-back'=>'#000','entry-title-text'=>'#0B96D0','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['red'] = array('block-highlight-back'=>'#CC0000','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['orange'] = array('block-highlight-back'=>'#FF7400','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['dark-orange'] = array('block-highlight-back'=>'#D64B00','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['light-blue'] = array('block-highlight-back'=>'#4096EE','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['pink'] = array('block-highlight-back'=>'#FF0084','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['purple'] = array('block-highlight-back'=>'#80185B','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['gold'] = array('block-highlight-back'=>'#C79810','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['green'] = array('block-highlight-back'=>'#008C00','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['blue'] = array('block-highlight-back'=>'#356AA0','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['mint'] = array('block-highlight-back'=>'#CDEB8B','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['dark-blue'] = array('block-highlight-back'=>'#3F4C6B','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors = array_merge($ValidSkinColors, $UserSkinColors);

if ( isset($_GET['color']) && isset($ValidSkinColors[$_GET['color']]) ) $SkinColor = $_GET['color'];
elseif ( !isset($ValidSkinColors[$SkinColor]) ) $SkinColor = 'black';

$UserStyle = $HTMLStylesFmt['equilibrium'];
$HTMLStylesFmt['equilibrium'] =
	'.featured .title,.latest .title,.featured .title h2 a,.latest .title h2 a'.
		'{color:'. $ValidSkinColors[$SkinColor]['entry-title-text']. '} '.
	'.featured-title h2 a:hover,.featured .title h2 a:hover{color:'. $ValidSkinColors[$SkinColor]['block-highlight-text'].'} '.
	'.featured .title,.latest .title{background:'. $ValidSkinColors[$SkinColor]['block-highlight-back'].'} '.
	'p a,p a:visited,.postMeta-post a,.postMeta-post a:visited,.featured .post-content h2 a,'.
	'.blogit-page-topigation a,.blogit-page-topigation a:visited,'.
	'.latest .post-content h2,#footer div a:hover,'.
	'#comments .commentmetadata li a'.
		'{color:'. $ValidSkinColors[$SkinColor]['text-highlight']. '} '.
	'#sidebar a:hover,#top a:hover,#siteheader ul a:hover,ul#top li.current_page_item a:link,'.
	'ul#top li.current_page_item a:visited,ul#top li.current_page_item a:hover,ul#top li.current_page_item a:active,'.
	'#siteheader ul li.current_page_item a:link,#siteheader ul li.current_page_item a:visited,#siteheader ul li.current_page_item a:hover,'.
	'#siteheader ul li.current_page_item a:active'.
		'{color:'. $ValidSkinColors[$SkinColor]['block-highlight-text'].
		' !important;background:'. $ValidSkinColors[$SkinColor]['block-highlight-back'].'} '.
	'#siteheader .sitetitle.logo a, #siteheader .sitetitle a'.
		'{color:'. $ValidSkinColors[$SkinColor]['title-text']. '} ';

global $PageLogoUrl, $PageLogoUrlHeight, $PageLogoUrlWidth,$HTMLStylesFmt;
if (!empty($PageLogoUrl)) {
	dg_SetLogoHeightWidth(15);
	$HTMLStylesFmt['equilibrium'] .=
		'#siteheader .sitetitle a{height:' .$PageLogoUrlHeight .'; background: url(' .$PageLogoUrl .') left top no-repeat} '.
		'#siteheader .sitetitle a, #siteheader .sitetag{padding-left: ' .$PageLogoUrlWidth .'} '.
		'#siteheader .sitetag{margin-top: ' .(45-substr($PageLogoUrlHeight,0,-2)) .'px}';
}
$HTMLStylesFmt['equilibrium'] .= $UserStyle;

# Allows classes on anchors
global $WikiStyleApply;
$WikiStyleApply['a'] = 'a';

# ----------------------------------------
# - Standard Skin Setup
# ----------------------------------------
$FmtPV['$WikiTitle'] = '$GLOBALS["WikiTitle"]';
$FmtPV['$WikiTag'] = '$GLOBALS["WikiTag"]';

# Move any (:noleft:) or SetTmplDisplay('PageLeftFmt', 0); directives to variables for access in jScript.
$FmtPV['$LeftColumn'] = "\$GLOBALS['TmplDisplay']['PageLeftFmt']";
Markup('noleft', 'directives',  '/\\(:noleft:\\)/ei', "SetTmplDisplay('PageLeftFmt',0)");
$FmtPV['$RightColumn'] = "\$GLOBALS['TmplDisplay']['PageRightFmt']";
Markup('noright', 'directives',  '/\\(:noright:\\)/ei', "SetTmplDisplay('PageRightFmt',0)");
$FmtPV['$ActionBar'] = "\$GLOBALS['TmplDisplay']['PageActionFmt']";
Markup('noaction', 'directives',  '/\\(:noaction:\\)/ei', "SetTmplDisplay('PageActionFmt',0)");
$FmtPV['$TabsBar'] = "\$GLOBALS['TmplDisplay']['PageTabsFmt']";
Markup('notabs', 'directives',  '/\\(:notabs:\\)/ei', "SetTmplDisplay('PageTabsFmt',0)");
$FmtPV['$SearchBar'] = "\$GLOBALS['TmplDisplay']['PageSearchFmt']";
Markup('nosearch', 'directives',  '/\\(:nosearch:\\)/ei', "SetTmplDisplay('PageSearchFmt',0)");
$FmtPV['$TitleGroup'] = "\$GLOBALS['TmplDisplay']['PageTitleGroupFmt']";
Markup('notitlegroup', 'directives',  '/\\(:notitlegroup:\\)/ei', "SetTmplDisplay('PageTitleGroupFmt',0)");
Markup('notitle', 'directives',  '/\\(:notitle:\\)/ei', "SetTmplDisplay('PageTitleFmt',0); SetTmplDisplay('PageTitleGroupFmt',0)");
Markup('fieldset', 'inline', '/\\(:fieldset:\\)/i', "<fieldset>");
Markup('fieldsetend', 'inline', '/\\(:fieldsetend:\\)/i', "</fieldset>");

# Override pmwiki styles otherwise they will override styles declared in css
global $HTMLStylesFmt;
$HTMLStylesFmt['pmwiki'] = '';

# Add a custom page storage location
global $WikiLibDirs;
$PageStorePath = dirname(__FILE__)."/wikilib.d/{\$FullName}";
$where = count($WikiLibDirs);
if ($where>1) $where--;
array_splice($WikiLibDirs, $where, 0, array(new PageStore($PageStorePath)));

# ----------------------------------------
# - Standard Skin Functions
# ----------------------------------------
function dg_SetSkinColor($default, $valid_colors){
global $SkinColor, $ValidSkinColors, $_GET;
	if ( !is_array($ValidSkinColors) ) $ValidSkinColors = array();
	$ValidSkinColors = array_merge($ValidSkinColors, $valid_colors);
	if ( isset($_GET['color']) && in_array($_GET['color'], $ValidSkinColors) )
		$SkinColor = $_GET['color'];
	elseif ( !in_array($SkinColor, $ValidSkinColors) )
		$SkinColor = $default;
	return $SkinColor;
}
function dg_PoweredBy(){
	print ('<a href="http://pmwiki.com/'.($GLOBALS['bi_BlogIt_Enabled']?'Cookbook/BlogIt">BlogIt':'">PmWiki').'</a>');
}
# Determine logo height and width
function dg_SetLogoHeightWidth ($wPad, $hPad=0){
global $PageLogoUrl, $PageLogoUrlHeight, $PageLogoUrlWidth;
	if (!isset($PageLogoUrlWidth) || !isset($PageLogoUrlHeight)){
		$size = @getimagesize($PageLogoUrl);
		if (!isset($PageLogoUrlWidth))  SDV($PageLogoUrlWidth, ($size ?$size[0]+$wPad :0) .'px');
		if (!isset($PageLogoUrlHeight))  SDV($PageLogoUrlHeight, ($size ?$size[1]+$hPad :0) .'px');
	}
}
