<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>
<div id="exhibit-nav">
  <ul class="exhibit-section-nav current" style="padding:0; margin:0;">
    <li style="font-weight:bold;">
      <?php
        $title = exhibit_builder_link_to_exhibit(get_current_record('exhibit'),
						 "Home",
						 array('class' => 'exhibit-section-title current'));
        echo $title;
      ?>
    </li>
  </ul>
  <div id="secondary">
    <?php 
      $uri = exhibit_builder_link_to_exhibit($exhibit);
    ?>
    <ul class="exhibit-section-nav">
      <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
      <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
        <?php 
          // fcd1, 7/31/13: replaced following, which also prints child
          // pages, with just a uri print
          // echo exhibit_builder_page_summary($exhibitPage); 
        ?>
        <?php 
          $html = '<li>' . '<a class="exhibit-section-list" href="' . 
                  exhibit_builder_exhibit_uri(get_current_record('exhibit'), $exhibitPage) . '">' . 
                  cul_insert_angle_brackets(metadata($exhibitPage, 'title')) . '</a></li>';
          echo $html;
        ?>
      <?php endforeach; ?>
    </ul>
  </div> <!--end id="secondary"-->
</div><!--end id="exhibit-nav"-->
<?php
  $uri = exhibit_builder_link_to_exhibit($exhibit);
  $divID = "solidBlock";
  $resovlerURL = '';

  $bannerImage = '';

  if (stristr($uri,'white')) {
    $bannerImage = "white-sm.jpg";
    $resolverUrl = 'http://www.columbia.edu/cgi-bin/cul/resolve?clio7665773';
  }
  else if (stristr($uri,'kio')) {
    $bannerImage = "kio-sm.jpg";
    $divID = "lightBlock";
    $resolverUrl = 'http://www.columbia.edu/cgi-bin/cul/resolve?clio7688161';
  }
  else if (stristr($uri,'quran')) {
    $bannerImage = "quran-header.jpg";
    $resolverUrl = 'http://www.columbia.edu/cgi-bin/cul/resolve?clio10216814';
  }
?>
<div id="content">
  <div id="<?php echo $divID; ?>">
    <table style="border-collapse:collapse">
      <tr>
        <td style="border-right:0px solid #fff;vertical-align:middle;padding:10px;width:380px">
          <h1>
            <?php
              $title = exhibit_builder_link_to_exhibit($exhibit);
              $matches = explode(":", $title, 2);
              if (!is_null($matches[0])) echo $matches[0];
            ?>
            <?php 
            if ( (count($matches) == 2) && (!is_null($matches[1]))) echo ":<br />" . $matches[1];
            ?>
          </h1>
        </td>
        <td>
          <img style='float:right' src="<?=img($bannerImage)?>" alt='header-image' />
        </td>
      </tr>
    </table>
  </div> <!--end id="solidBlock" / "lightBlock" -->
  <br style="clear:both" />
  <div class="exhibit-description">
    <?php echo $exhibit->description; ?>
  </div> <!-- exhibit-description -->
  <div id="exhibit-credits">	
    <h3>Exhibit Curator</h3>
    <?php echo $exhibit->credits; ?>
  </div> <!-- exhibit-credits -->
  <div id="exhibit-sections">
    <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
      <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
        <?php 
          $html = '<h3><a href="' . 
                  exhibit_builder_exhibit_uri(get_current_record('exhibit'), $exhibitPage) . '">' .
     		  cul_insert_angle_brackets(metadata($exhibitPage, 'title')) . '&nbsp;&raquo;' . '</a></h3>';
          echo $html;
          // fcd1, 01/08/15:                                                                                                                                
          // function exhibit_builder_page_text(), available in plugin Exhibit Builder version 2.1.1,                                                       
          // has been removed from Exhibit Builder 3.1.1, which is the version bundled with Omeka 2.2.2 .                                                   
          // Old code:                                                                                                                                      
          // if (exhibit_builder_page_text(1)) {
          //  $pageText = exhibit_builder_page_text(1);
          //  echo $pageText;
          // }
          // New code (Exhibit Builder 3.1.1 uses content blocks):                                                                                          
          $pageBlocks = $exhibitPage->getPageBlocks();
          $textBlock = $pageBlocks[0];
          $pageText = $textBlock->text;
          echo $pageText;
        ?>
      <?php endforeach; ?>
  </div> <!--end id="exhibit-sections" -->
  <?php 
    $bookmark ='<div style="float:right;font-style:italic"><p>Bookmark this page as: <a href="' . $resolverUrl . '">' . $resolverUrl . '</a></p></div>' . "\n";

    //if (stristr($uri, 'white'))
    echo $bookmark;
  ?>
</div> <!--end id="content" -->
<?php echo foot(); ?>