<?php
echo head(array('title' => metadata('exhibit', 'title'),
		'bodyclass' => 'exhibits show'));
?>
<?php
  // fcd1, 9/9/11: In Omeka 1.5.3, exhibitions had sections, with no landing page.
  // When a section was selected, the first page in the section was displayed
  // From Omeka 2.0 on, there are no more sections. Instead, there are top-level
  // pages, which can have content, and these top-level pages can have child pages.
  // To mimic the Omeka 1.5.3 behavior for legacy exhibitions that were ported to
  // Omeka 2.1, we need to check if the current page is a top-level page, and 
  // display the content of the first child, if there is one. We also need this 
  // info so that "Next" links to the correct page
  $currentExhibitPage = get_current_record('exhibit_page');
  $exhibitPageParent = $currentExhibitPage->getParent();      
  $firstChild = null;
  if (!($exhibitPageParent)) {
    // this is a top-level page, and we want section-like behavior. First page in "section" will display
    // and the breadcrumb links have to reflect this
    $firstChild = $currentExhibitPage->getFirstChildPage();
  }
?>
<div id="exhibit-nav">
  <div id="secondary">
    <?php 
      echo cul_legacy_exhibit_builder_page_nav($firstChild);
    ?>
  </div> <!-- end id="secondary" -->
</div> <!-- end id="exhibit-nav" -->
<div id="content">
  <div id="primary">
    <div class="exhibit-content">
      <?php $pn = culWritePrevNext($firstChild); ?>
      <?php echo $pn; ?>
      <?php 
        echo cul_general_breadcrumb($firstChild); 
        exhibit_builder_render_exhibit_page($firstChild);
      ?>
    </div> <!-- end id="exhibit-content" -->
  </div><!--end id="primary"-->
  <?php $pn = culWritePrevNext($firstChild); ?>
  <?php echo $pn; ?>
</div> <!-- end id="content" -->
<?php echo foot(); ?>
