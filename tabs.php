<?php
	require_once("aplication_top.php");	
	$title_header_page = TITLE_PAGE;
	$description_header_page = TITLE_DESCRIPTION;
	$keyword_header_page = TITLE_KEYWORD;
	include("header.php");
?>

<script language="javascript" src="<?php echo _URL?>js/tabs.js"></script>

<div class="Fly-tabs">

<dl class="tabs" id="pane">
    <dt class="tab1"><span>Description</span></dt><dd><div class="desc"><div class="text"><p>But travelling is very complicated activity that is why you must be prepared to any kinds of surprises. In ancient times travellers have used maps as the main source of information. The globe and the map are the small model of our world. Nowadays maps are very useful thing especially when you want to explore some wild spots. Of course you can rely on your GPS system but we must never forget our past because new technologies are more vulnerable than good-old stuff. </p></div></div></dd><dt class="tab3"><span>Reviews</span>
    </dt>

<dd><div>

	<div class="customer-reviews">
		<form method="post" action="/virtuemart_41126/index.php/shop/hawaii/product-15-details" name="reviewForm" id="reviewform">
			<div class="list-reviews">
							<span class="step">There are yet no reviews for this product.</span>
					<div class="clear"></div>
		</div>

					<input type="hidden" name="virtuemart_product_id" value="15" />
                        <input type="hidden" name="option" value="com_virtuemart" />
                        <input type="hidden" name="virtuemart_category_id" value="4" />
                        <input type="hidden" name="virtuemart_rating_review_id" value="0" />
                        <input type="hidden" name="task" value="review" />
                    </form>
		</div>
	</div>
</dd>

</dl>
</div>
</body>
</html>