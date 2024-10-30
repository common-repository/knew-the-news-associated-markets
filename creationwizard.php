<div style="">
<form id="marketcreationwizardform">
<ul class="marketcreationsteps">
	<li class="shown" title="Welcome">
		<h3>Welcome to the Knew The News market creation wizard.</h3>
		<p>This wizard will guide you throught the process of market creation on Knew The News.</p>
		<br />
		<p>We're able to re-use some of the information you've already added to your post here, 
			to make the process as easy as possible.</p>
		<br />
		<p>Click on "Next" to begin!</p>
	</li>
	<li class="hidden" title="Background &amp; Tags">
		<h3>Provide some background, and tag it</h3>
		<p>Using the content from your blog entry, background information
		for the prediction market you are creating is composed.</p>
		<textarea id="marketdescription" name="market[description]" style="width:100%;overflow-x:hidden;height:80px;font-size:0.8em"></textarea>
		<p><br />Re-use the tags from your blog post (comma seperated).</p>
		<input type="text" id="markettags" name="market[tags]" style="width:100%" />
	</li>
	<li class="hidden" title="Title &amp; Category">
		<h3>Write your question and set the category</h3>
		<p>Phrase a question, based on the story in your blog. Any question would do, 
		simply write a sentence starting with <i>Will...</i>, <i>Who...</i> or <i>When...</i>.</p>
		<textarea id="markettitle" name="market[title]"
			style="font-size:12pt;font-weight:bold;width:100%"></textarea>
		
		<p><br />Set the category in which the market will be published:</p>
		<select id="marketcategory" name="market[category]" style="width:100%;height:25px">
			<option value="">-- Please Select --</option>
			<optgroup label="General"><option value="General&gt;Knew The News">&nbsp;&nbsp;General » Knew The News</option><option value="General&gt;Crime">&nbsp;&nbsp;General » Crime</option><option value="General&gt;Litigation">&nbsp;&nbsp;General » Litigation</option><option value="General&gt;Weather">&nbsp;&nbsp;General » Weather</option><option value="General&gt;Other">&nbsp;&nbsp;General » Other</option></optgroup><optgroup label="Entertainment"><option value="Entertainment&gt;Awards">&nbsp;&nbsp;Entertainment » Awards</option><option value="Entertainment&gt;Celebrities">&nbsp;&nbsp;Entertainment » Celebrities</option><option value="Entertainment&gt;Movies">&nbsp;&nbsp;Entertainment » Movies</option><option value="Entertainment&gt;Music">&nbsp;&nbsp;Entertainment » Music</option><option value="Entertainment&gt;TV Shows">&nbsp;&nbsp;Entertainment » TV Shows</option><option value="Entertainment&gt;Television">&nbsp;&nbsp;Entertainment » Television</option><option value="Entertainment&gt;Other">&nbsp;&nbsp;Entertainment » Other</option></optgroup><optgroup label="Technology"><option value="Technology&gt;Consumer Electronics">&nbsp;&nbsp;Technology » Consumer Electronics</option><option value="Technology&gt;Internet">&nbsp;&nbsp;Technology » Internet</option><option value="Technology&gt;Computer">&nbsp;&nbsp;Technology » Computer</option><option value="Technology&gt;Other">&nbsp;&nbsp;Technology » Other</option></optgroup><optgroup label="Business"><option value="Business&gt;Deals">&nbsp;&nbsp;Business » Deals</option><option value="Business&gt;Economics">&nbsp;&nbsp;Business » Economics</option><option value="Business&gt;Indices">&nbsp;&nbsp;Business » Indices</option><option value="Business&gt;People">&nbsp;&nbsp;Business » People</option><option value="Business&gt;Results">&nbsp;&nbsp;Business » Results</option><option value="Business&gt;Other">&nbsp;&nbsp;Business » Other</option></optgroup><optgroup label="Sports"><option value="Sports&gt;Soccer">&nbsp;&nbsp;Sports » Soccer</option><option value="Sports&gt;Basketball">&nbsp;&nbsp;Sports » Basketball</option><option value="Sports&gt;Baseball">&nbsp;&nbsp;Sports » Baseball</option><option value="Sports&gt;Football">&nbsp;&nbsp;Sports » Football</option><option value="Sports&gt;Ice Hockey">&nbsp;&nbsp;Sports » Ice Hockey</option><option value="Sports&gt;Tennis">&nbsp;&nbsp;Sports » Tennis</option><option value="Sports&gt;Formula 1">&nbsp;&nbsp;Sports » Formula 1</option><option value="Sports&gt;Wintersports">&nbsp;&nbsp;Sports » Wintersports</option><option value="Sports&gt;Athletics">&nbsp;&nbsp;Sports » Athletics</option><option value="Sports&gt;Olympics">&nbsp;&nbsp;Sports » Olympics</option><option value="Sports&gt;Other">&nbsp;&nbsp;Sports » Other</option></optgroup><optgroup label="Politics"><option value="Politics&gt;European Union">&nbsp;&nbsp;Politics » European Union</option><option value="Politics&gt;Western Europe">&nbsp;&nbsp;Politics » Western Europe</option><option value="Politics&gt;Eastern Europe">&nbsp;&nbsp;Politics » Eastern Europe</option><option value="Politics&gt;United States">&nbsp;&nbsp;Politics » United States</option><option value="Politics&gt;Anglo America">&nbsp;&nbsp;Politics » Anglo America</option><option value="Politics&gt;Latin America">&nbsp;&nbsp;Politics » Latin America</option><option value="Politics&gt;Africa">&nbsp;&nbsp;Politics » Africa</option><option value="Politics&gt;Middle East">&nbsp;&nbsp;Politics » Middle East</option><option value="Politics&gt;Asia">&nbsp;&nbsp;Politics » Asia</option><option value="Politics&gt;South Pacific">&nbsp;&nbsp;Politics » South Pacific</option><option value="Politics&gt;Inter-/Multinational">&nbsp;&nbsp;Politics » Inter-/Multinational</option><option value="Politics&gt;Other">&nbsp;&nbsp;Politics » Other</option></optgroup><optgroup label="Science"><option value="Science&gt;Discoveries">&nbsp;&nbsp;Science » Discoveries</option><option value="Science&gt;Environment">&nbsp;&nbsp;Science » Environment</option><option value="Science&gt;Space">&nbsp;&nbsp;Science » Space</option><option value="Science&gt;Other">&nbsp;&nbsp;Science » Other</option></optgroup>
		</select>
		
	</li>
	<li class="hidden" title="Outcomes">
		<h3>Possible outcomes</h3>
		<p>Specify the possible outcomes/results of your question.</p>
		<p>For each option, set an initial likelyhood between 1 and 99%.</p>
		<table id="wizardoptions">
		<tbody>
		<tr>	
			<td><input type="hidden" name="market[options][id][0]" value="0" />
				<input type="text" style="width:400px" id="marketoptionslabel0" name="market[options][label][0]" class="marketoptionlabel" onchange="wizardCalcOptionTotal()" value="Yes" /></td>
			<td><input type="text" id="marketoptionsvalue0" name="market[options][value][0]" class="marketoptionvalue" onchange="wizardCalcOptionTotal()" value="50" style="width:30px" /> %</td>
		</tr>
		<tr>	
			<td><input type="hidden" name="market[options][id][1]" value="0" />
				<input type="text" style="width:400px" id="marketoptionslabel1" name="market[options][label][1]" class="marketoptionlabel" onchange="wizardCalcOptionTotal()" value="No" /></td>
			<td><input type="text" id="marketoptionsvalue1" name="market[options][value][1]" class="marketoptionvalue" onchange="wizardCalcOptionTotal()" value="50" style="width:30px" /> %</td>
		</tr>
		<tr>	
			<td><input type="hidden" name="market[options][id][2]" value="0" />
				<input type="text" style="width:400px" id="marketoptionslabel2" name="market[options][label][2]" class="marketoptionlabel" onchange="wizardCalcOptionTotal()" value="" /></td>
			<td><input type="text" id="marketoptionsvalue2" name="market[options][value][2]" class="marketoptionvalue" onchange="wizardCalcOptionTotal()" value="" style="width:30px" /> %</td>
		</tr>
		<tr>	
			<td><input type="hidden" name="market[options][id][3]" value="0" />
				<input type="text" style="width:400px" id="marketoptionslabel3" name="market[options][label][3]" class="marketoptionlabel" onchange="wizardCalcOptionTotal()" value="" /></td>
			<td><input type="text" id="marketoptionsvalue3" name="market[options][value][3]" class="marketoptionvalue" onchange="wizardCalcOptionTotal()" value="" style="width:30px" /> %</td>
		</tr>
		<tr>	
			<td><input type="hidden" name="market[options][id][4]" value="0" />
				<input type="text" style="width:400px" id="marketoptionslabel4" name="market[options][label][4]" class="marketoptionlabel" onchange="wizardCalcOptionTotal()" value="" /></td>
			<td><input type="text" style="width:30px" id="marketoptionsvalue4" name="market[options][value][4]" class="marketoptionvalue" onchange="wizardCalcOptionTotal()" value="" /> %</td>
		</tr>
		</tbody>
		<tfoot>
		<tr>	
			<td><input type="hidden" id="totaloptioncount" name="totaloptioncount" value="2" />
			<input type="hidden" id="totaloptionvalue" name="totaloptionvalue" value="100" /></td>
			<td><span id="totaloptionvaluelabel">100</span> %</td>
		</tr>
		</tfoot>
		</table>
		
		
	</li>
	<li class="hidden" title="Roundup">
		<h3>Settlement Details and Suspension</h3>
		<p>In case there a specific conditions to be met to qualify for settlement,
			you should specify them here.</p>
		<textarea id="marketsettlementdetails" name="market[settlementdetails]" style="width:100%">As reported by a major mainstream news source.</textarea>
		<p>Finally: When should the market suspend? Chose a date close to a possible settlement.</p>
		<?php
			$publicationdate = time();	
			$suspensiondate = time() + 604800;
			$suspend = new DateTime("@".$suspensiondate);
		?>
		<input type="text" style="width:85px;position: relative;top: 2px" name="market[suspensiondate]" id="marketsuspensiondate" maxlength="10" size="12"  
		value="<?php print $suspend->format("m/d/Y") ?>"/>
		<select style="width:50px;" name="market[suspensiontimehour]" id="marketsuspensiontimehour">
		<?php
			for($hour = 0; $hour < 24; $hour++)
			{
				$selected = ($hour == date("H", $suspensiondate)) ?
							" selected=\"selected\"" : "";
				$hour = ($hour < 10 ? "0" : "") . $hour;
				print "<option" . $selected . " value=\"" . $hour . "\">" . $hour . "&nbsp;&nbsp;</option>";
			}
		?>
		</select>
		<select style="width:50px;" name="market[suspensiontimeminute]" id="marketsuspensiontimeminute">
		<?php
			for($minute = 0; $minute < 60; $minute += 5)
			{
				$selected = ($minute >= (int)date("i", $suspensiondate)
							&& ($minute) < (int)date("i", $suspensiondate)+5) ?
							" selected=\"selected\"" : "";
				$minute = ($minute < 10 ? "0" : "") . $minute;
				print "<option" . $selected . " value=\"" . $minute . "\">" . $minute . "&nbsp;&nbsp;</option>";
			}
		?>
		</select>
		<input type="hidden" name="market[suspension]" id="marketsuspension" value="<?php print date("Y m d H i", $suspensiondate) ?>" />
	</li>
	<li class="hidden" title="Complete">
		<h3>Congratulations, you just completed your Knew The News prediction market!</h3>
		<p>By clicking the "Done!" button, this wizard will close and your
			question will be submitted to Knew The News.</p>
		<p>On the details page for this market on Knew The News, a link to your blog 
			entry will appear. </p>
		<p>The market will be created immediatly when closing this wizard.</p>
	</li>
</ul>
</form>
<div style="margin-bottom:20px">

	<span style="float:left">Progress:&nbsp;&nbsp;</span>
	<ul class="marketcreationprogress">
		<li class="active"></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>

</div>
<br style="clear:both" />
<div>

	<input type="button" class="button" onclick="return $j('#knewthenewsmarketwidget_createdialog').dialog('close');" 
		style="margin-right:20px;" value="Abort" />
	<input type="button" class="button" onclick="return loadWizard();" 
	 	style="margin-right:20px;display:none;" value="Restart" />
	
	<input id="marketcreationwizarddonebutton" type="button" class="button" name="donebutton" 
		style="margin-left:20px;float:right;display:none;" value="Done!" onclick="return associateMarket()" />
	<img src="images/wpspin_light.gif" 
		 id="associatemarketbusy" style="display:none;top:3px;position:relative;visibility:visible;" class="ajax-loading" />
	<span id="associatemarketstatus"></span>
	<input id="marketcreationwizardnextbutton" type="button"  class="button"
		onclick="nextWizardStep()" style="margin-left:20px;float:right" value="Next &raquo;" />
	<input id="marketcreationwizardprevbutton" type="button"  class="button"
		onclick="previousWizardStep()" style="float:right;display:none" value="&laquo; Previous" />

</div>
<br style="clear:both" />

<script type="text/javascript">

function nextWizardStep() {
	if (validateStep($j('.marketcreationsteps').children('.shown').index())) {
		$j('.marketcreationsteps').children('.shown')
			.removeClass("shown").addClass("hidden")
			.next().removeClass("hidden").addClass("shown");
		updateWizardButtons();
	}
}
function previousWizardStep() {
	$j('.marketcreationsteps').children('.shown')
		.removeClass("shown").addClass("hidden")
		.prev().removeClass("hidden").addClass("shown");
	updateWizardButtons();
}
function updateWizardButtons() {
	var headline = $j('#marketcreationwizard').attr('title') + ' &middot; '
		+ $j('.marketcreationsteps').children('.shown').attr('title');
	$j('#marketcreationwizard h4 span.title').html(headline);
	var count = $j('.marketcreationsteps').children('li').length;
	var idx = $j('.marketcreationsteps').children('.shown').index();
	if (idx > 0) {
		$j('#marketcreationwizardprevbutton').show();
	}
	else {
		$j('#marketcreationwizardprevbutton').hide();
	}
	if  (idx < count - 1 && idx >= 0) {
		$j('#marketcreationwizardnextbutton').show();
	}
	else {
		$j('#marketcreationwizardnextbutton').hide();
	}
	if (idx == count - 1) {
		$j('#marketcreationwizarddonebutton').show();
	}
	else {
	//	$j('#marketcreationwizarddonebutton').hide();
	}
	$j('.marketcreationprogress li').each(function(i, e){
		if (i <= idx)
			$j(e).addClass('active');
		else
			$j(e).removeClass('active');
	});
}
function validateStep(i) {
	var result = true;
	switch(i) {
		case 1: result &= $j('#marketcreationwizardform').validate().element('#marketdescription');
				result &= $j('#marketcreationwizardform').validate().element('#markettags');	
			break;
		case 2: result &= $j('#marketcreationwizardform').validate().element('#markettitle');
				result &= $j('#marketcreationwizardform').validate().element('#marketcategory');	
			break;
		case 3: result &= $j('#marketcreationwizardform').validate().element('#totaloptioncount');
				result &= $j('#marketcreationwizardform').validate().element('#totaloptionvalue');
				result &= $j('#marketcreationwizardform').validate().element('#marketoptionsvalue0');	
				result &= $j('#marketcreationwizardform').validate().element('#marketoptionsvalue1');	
			break;
	}
	return result;
}

$j('#marketsuspensiondate').change(function(){setSuspensionDate();});
$j('#marketsuspensiontimehour').change(function(){setSuspensionDate();});
$j('#marketsuspensiontimeminute').change(function(){setSuspensionDate();});

$j('#marketcreationwizardform').validate({   
	errorClass: "validationerror",
	rules: {
		"market[title]": { required: true },
		"market[category]": { required: true },
		"market[description]": { required: true },
		"market[tags]": { required: true },
		"totaloptioncount": { required: true, range: [2, 5] },
		"totaloptionvalue": { required: true, range: [100, 100] },
		"market[options][value][0]": { required: true, range: [1, 99] },
		"market[options][value][1]": { required: true, range: [1, 99] },
		"market[options][value][2]": { required: false, range: [1, 99] },
		"market[options][value][3]": { required: false, range: [1, 99] },
		"market[options][value][4]": { required: false, range: [1, 99] }
	},
    messages: {
     	"totaloptioncount": "Please specify at least two possible outcomes.", 
     	"totaloptionvalue": "The total value of all options must sum up to exactly 100.",
		"market[options][value][0]": "*",
		"market[options][value][1]": "*",
		"market[options][value][2]": "*",
		"market[options][value][3]": "*",
		"market[options][value][4]": "*"
    },
	submitHandler: function(f) { return; }
});

$j('#marketdescription').val($j('#content').val());
$j('#markettags').val($j('#tax-input-post_tag').val());

function wizardAddOptionRow()
{
	toggleButtons();
	wizardCalcOptionTotal();
}

function wizardCalcOptionTotal() 
{
	var values = $j('#wizardoptions tbody tr td input.marketoptionvalue');
	var total = 0;
	values.each(
		function(){
			var v = parseFloat($j(this).val());
			if (!isNaN(v))
				total += v;
		}
	);
	total = Math.round(total * 100) / 100;
	if (total != 100)
		$j('#totaloptionvaluelabel').html("<span class='validationerror'>" + total + "</span>");
	else
		$j('#totaloptionvaluelabel').text(total);
	$j('#totaloptionvalue').val(total);
	var labels = $j('#wizardoptions tbody tr td input.marketoptionlabel');
	var count = 0;
	labels.each(
		function(){
			var v = $j(this).val();
			if (v != "")
				count++;
		}
	);
	$j('#totaloptioncount').val(count);
}

function setSuspensionDate()
{
	var d = $j('#marketsuspensiondate').val().split("/");
	$j('#marketsuspension').val(
		d[2] + " " + d[0] + " " + d[1]
		+ " " +  $j('#marketsuspensiontimehour').val()
		+ " " +  $j('#marketsuspensiontimeminute').val()
	);
	$j('#marketcreationwizardform').validate().element('#marketsuspension');
}
</script>

</div>