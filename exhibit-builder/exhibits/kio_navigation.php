<?php
// FROM EXHIBIT BUILDER PLUGIN helpers/ExhibitSectionFunctions.php
// with a quick tweak

echo '<ul class="exhibit-section-nav">';
$kio = $outbreak = false;
$indent = '';
$uri = exhibit_builder_link_to_exhibit($exhibit);
if (stristr($uri, 'kio')) {
        $kio = true;
}
foreach ($exhibit->Sections as $key => $exhibitSection) {
        if ($kio) {
                $uri = exhibit_builder_exhibit_uri($exhibit, $exhibitSection);
                if (stristr($uri, 'outbreak_part1') && !$outbreak) {
                        $html .= '<li style="color:#77403e"><a href="' . $uri . '">Korean Independence Outbreak, 1919:</a></li>';
                        $outbreak = !$outbreak;
                        $indent = 'style="margin-left:10px"';
                }
        }

        if ($exhibitSection->hasPages()) {
                	$html .= '<li ' . $indent . (exhibit_builder_is_current_section($exhibitSection) ? ' class="current"' : ''). '><a class="exhibit-section-title" href="' . html_escape(exhibit_builder_exhibit_uri($exhibit, $exhibitSection)) . '">' . html_escape($exhibitSection->title) . '</a>';
			if (exhibit_builder_is_current_section($exhibitSection))
				$html .=  exhibit_builder_page_nav($exhibitSection);
			$html .= "</li>\n";
        }
}
$html .= '</ul>';
$html = apply_filters('exhibit_builder_section_nav', $html, $exhibit);
echo $html;
?>

