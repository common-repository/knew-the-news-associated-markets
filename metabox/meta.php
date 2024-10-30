<p>
	You can associate one or more prediction markets from Knew The News with this blog post.
	Simply enter a search term and pick one or more entries from the results list.
</p>
<p>
	In case you wish to integrate the Knew The News prediction market directly in your post text,
	use placeholders in this form: "[KnewTheNewsMarket-N]" (without quotes) where N 
	should be replaced by the number of the associated displayed below, starting with 1.
</p>

<h4>Currently Associated markets</h4>
<table id="associatedentries">
<thead
<?php if (!is_array($meta) || count($meta["id"]) <= 0) { ?>
 style="display:none"
<?php } ?>
>
<tr>
	<th>Label</th>
	<th>Style</th>
	<th></th>
</tr>
</thead>
<tbody>
<?php
	if (is_array($meta) && count($meta["id"]) > 0)
	{
		for ($i = 0; $i < count($meta["id"]); $i++) {
			$id = $meta["id"][$i];
			$label = $meta["label"][$i];
			$style = $meta["style"][$i];
?>
	<tr class="associatedentry associatedentry-<?php print $id; ?>">
		<td width="auto">
			<input type="text" value="<?php print $label; ?>" name="_knewthenews_associatemarkets[label][]" class="label" />
		</td>
		<td width="200px">
			<select name="_knewthenews_associatemarkets[style][]">
				<option <?php if($style == "title"){ print 'selected="selected"'; } ?> value="title">Title only</option>
				<option <?php if($style == "graph"){ print 'selected="selected"'; } ?> value="graph">Title and graph</option>
				<option <?php if($style == "table"){ print 'selected="selected"'; } ?> value="table">Title and options list</option>
			</select>
			<input type="hidden" value="<?php print $id; ?>" name="_knewthenews_associatemarkets[id][]" class="id" />
		</td>
		<td width="70px">
			<input type="button" class="button" value="Remove" onclick="javascript: removeEntry(<?php print $id; ?>);" class="remove" />
		</td>
	</tr>
<?php					
		}
?>
	<tr id="nomarketshint" style="display:none"><td colspan="3">No markets associated.</td></tr>
<?php
	}
	else
	{
?>
	<tr id="nomarketshint"><td colspan="3">No markets associated.</td></tr>
<?php		
	}
?>	
</tbody>
</table>

<input type="button" class="button" onclick="return $j('#knewthenewsmarketwidget_selectdialog').dialog('open');" style="margin-top: 10px;" value="Add Existing..." />

<?php if (get_user_meta($post->post_author, 'knewthenews_username', true ) && get_user_meta($post->post_author, 'knewthenews_username', true )) { ?>
<input type="button" class="button" onclick="return loadWizard();" style="margin-top: 10px;" value="Create New..." />	
<?php } else { ?>
<p><strong>Please note</strong> You have not provided Knew The News username and password in <a href="profile.php#knewthenews">your WordPress profile</a>.
When providing valid authentication credentials, Knew The New will link to your blog article.
Additionally, you will be able to submit a new Knew The News market directly from within this
blog admin page.</p>
<?php } ?>

<div id="knewthenewsmarketwidget_selectdialog" style="display:none;background:white;">

	<p>Select markets from Knew The News to be associated with this blog article.</p>
	
	<p>The markets will be included in the blog page at the end of the article. Select the
		type of appearance using the dropdowns. You may change the title of the market.</p>
	<p>
		<label for="">Enter a keyword to perform a search on Knew The News markets:</label>
		<input type="text" 
			onchange="return searchMarkets($j(this).val());"
			onkeypress="return searchMarkets($j(this).val());"
			/>
		<img src="<?php print get_bloginfo('wpurl') ?>/wp-admin/images/wpspin_light.gif" 
			style="top:3px;position:relative;visibility:visible;" class="ajax-loading" />
		<span class="hint" style="display:none;" >Please enter at least 3 characters.</span>
	</p>
	
	<div class="widget" id="searchresult" style="border:1px solid #DDDDDD;padding:6px;margin:0px;margin-bottom:10px"></div>

	<input type="button" class="button" onclick="return $j('#knewthenewsmarketwidget_selectdialog').dialog('close');" value="Close" />

</div>

<div id="knewthenewsmarketwidget_createdialog">

	<div id="knewthenewscreatemarketwizard"></div>

</div>

<script type="text/javascript">

var $j = jQuery.noConflict();

var username = '<?php print get_user_meta($post->post_author, 'knewthenews_username', true )?>';
var password = '<?php print get_user_meta($post->post_author, 'knewthenews_password', true )?>';
	
var xhr;

$j(document).ready(function(){

	$j('#knewthenewsmarketwidget_selectdialog .ajax-loading').hide();
			
	$j('#knewthenewsmarketwidget_selectdialog')
		.dialog({ 
			modal: true, autoOpen: false, width: 500, dialogClass: 'widget ktndialog',
			title: 'Select prediction markets from Knew The News'
		});
		
	$j('#knewthenewsmarketwidget_createdialog')
		.dialog({ 
			modal: true, autoOpen: false, width: 500, height: 380, dialogClass: 'widget ktndialog',
			title: 'Create a news prediction market on Knew The News'
		});
		
});

function loadWizard() {

	$j('#knewthenewsmarketwidget_createdialog').dialog('open');
	
<?php

	if (get_user_meta($post->post_author, 'knewthenews_username', true)
	 		&& get_user_meta($post->post_author, 'knewthenews_password', true))
	{
?>		

	$j('#knewthenewscreatemarketwizard').html(
		'<img src="<?php print get_bloginfo('wpurl') ?>/wp-admin/images/wpspin_light.gif" class="ajax-loading" /> Loading...'
	);
		
	$j.ajax({
		url: "<?php print get_bloginfo('wpurl') ?>/wp-content/plugins/knew-the-news-associated-markets/creationwizard.php",
		dataType: "html", cache: false,
		success: function(response) { 
			$j('#knewthenewscreatemarketwizard').html(response);
		}
	});

	
<?php
	} else {
?>

	$j('#knewthenewscreatemarketwizard').html(
		'<div style="padding: 40px; line-height:1.5em;height:225px">To use this function, you must first provide a valid username and password for Knew The News in your profile settings.</div><input class="button" type="button" onclick="return $j(\'#knewthenewsmarketwidget_createdialog\').dialog(\'close\');" style="margin-right:20px;" value="Abort" />'
	);


<?php		
	}
?>	
}

function associateMarket() {
	knewthenewsAuthenticate(function(auth_token) { knewthenewsSubmitMarket(auth_token); });
}

function knewthenewsAuthenticate(callback) {
	
	$j('#associatemarketbusy').show();
	$j('#associatemarketstatus').html("Authentication...");
	$j.ajax({
		url: "<?php print get_bloginfo('wpurl') ?>/wp-content/plugins/knew-the-news-associated-markets/proxy.php?t=" + Math.random() + "&url=" + encodeURIComponent("auth.gettoken?username=" + username + "&password=" + password),
		dataType: "xml",
		success: function(xml) { 
			$j('#associatemarketbusy').hide();
			if (!$j('response', xml).attr("success") == "true") {
				$j('#associatemarketstatus')
					.html("Authentication failed. Please verify username and password in your profile settings.");
			} else {
				$j('#associatemarketstatus')
					.html("Authentication completed.");
				callback($j('result', xml).text());
			}
		}
	});
}

function knewthenewsSubmitMarket(auth_token) {
	
	$j('#associatemarketbusy').show();
	$j('#associatemarketstatus').html("Submitting data...");
	
	var data = {
		
		"market[description]": $j('#marketdescription').val(),
		"market[title]": $j('#markettitle').val(),
		"market[tags]": $j('#markettags').val(),
		"market[category]": $j('#marketcategory').val(),
		"market[settlementdetails]": $j('#marketsettlementdetails').val(),
		"market[suspension]": $j('#marketsuspension').val(),
	
        "market[options][id][0]": 0,
        "market[options][id][1]": 0,
        "market[options][id][2]": 0,
        "market[options][id][3]": 0,
        "market[options][id][4]": 0,
        "market[options][id][5]": 0,
        "market[options][value][0]": $j('#marketoptionsvalue0').val(),
		"market[options][value][1]": $j('#marketoptionsvalue1').val(),
		"market[options][value][2]": $j('#marketoptionsvalue2').val(),
		"market[options][value][3]": $j('#marketoptionsvalue3').val(),
        "market[options][value][4]": $j('#marketoptionsvalue4').val(),
		"market[options][value][5]": $j('#marketoptionsvalue5').val(),
		"market[options][label][0]": $j('#marketoptionslabel0').val(),
        "market[options][label][1]": $j('#marketoptionslabel1').val(),
        "market[options][label][2]": $j('#marketoptionslabel2').val(),
        "market[options][label][3]": $j('#marketoptionslabel3').val(),
        "market[options][label][4]": $j('#marketoptionslabel4').val(),
        "market[options][label][5]": $j('#marketoptionslabel5').val()
    }
	
	$j.ajax({
		url: "<?php print get_bloginfo('wpurl') ?>/wp-content/plugins/knew-the-news-associated-markets/proxy.php?t=" + Math.random() + "&url=" + encodeURIComponent("predictionmarkets.savemarket?auth_token=" + auth_token),
		dataType: "xml", data: data, type: "POST",
		success: function(xml) { 
			$j('#associatemarketbusy').hide();
			if (!$j('response', xml).attr("success") == "true") {
				$j('#associatemarketstatus')
					.html("Market data could not be submitted.");
			} else {
				$j('#associatemarketstatus')
					.html("Completed.");
				$j('#knewthenewsmarketwidget_createdialog')
					.fadeOut(1000, function(){$j('#knewthenewsmarketwidget_createdialog').dialog('close').fadeIn()});
				var id = $j('errtext', xml).text();
				var label = $j('#markettitle').val();
				selectEntry(id, label);
			}
		}
	});
	
	
}

function searchMarkets(q) {
	
	if (q.length >= 3)
	{
		if ($j('#searchresult').attr("q") != q)
		{
			$j('#searchresult').attr("q", q);
			$j('#knewthenewsmarketwidget_selectdialog .hint').hide();
			$j('#knewthenewsmarketwidget_selectdialog .ajax-loading').show();
			if (xhr)
				xhr.abort();
			xhr = $j.ajax({
				url: "<?php print get_bloginfo('wpurl') ?>/wp-content/plugins/knew-the-news-associated-markets/proxy.php?t=" + Math.random() + "&url=" + encodeURIComponent("predictionmarkets.searchmarkets?key=" + encodeURIComponent(q) + "&state=open"),
				dataType: "xml",
				success: function(xml) {
					var list = "<ul class='results'>";
					$j('item', xml).each(function(){
						list += "<li><a href='javascript: selectEntry(" + $j("id:first", this).text() + ");' id='listentry-" + $j("id:first", this).text() + "'>" + $j("title", this).text() + "</a></li>";
					});
					list += "</ul>";
					$j('#searchresult').html(list);
					$j('#knewthenewsmarketwidget_selectdialog .ajax-loading').hide();
				}
			});
		}
	}
	else
	{
		$j('#knewthenewsmarketwidget_selectdialog .hint').show();
	}	
}

function selectEntry(id, label) {
	
	if (!label)
		label = $j('#listentry-' + id).text();
	var li = $j('<tr class="associatedentry associatedentry-' + id + '"><td width="auto"><input class="label" type="text" name="_knewthenews_associatemarkets[label][]" value=""/></td><td width="200px"><select name="_knewthenews_associatemarkets[style][]"><option value="title">Title only</option><option value="graph">Title and graph</option><option value="table">Title and options list</option></select><input class="id" type="hidden" name="_knewthenews_associatemarkets[id][]" value="' + id + '"/></td><td width="70px"><input type="button" class="button remove" onclick="javascript: removeEntry(' + id + ');" value="Remove" /></td></tr>');
	$j(".label", li).val(label);
	$j(".id", li).val(id);
	$j('#associatedentries').append(li);
	$j('#nomarketshint').hide();
	$j('#associatedentries thead').show();
	$j('#knewthenewsmarketwidget_selectdialog').dialog("close");
}

function removeEntry(id) {
	$j('.associatedentry-'+id).remove();
	if ($j('.associatedentry').length == 0)
	{
		$j('#nomarketshint').show();
		$j('#associatedentries thead').hide();
	}
}



</script>