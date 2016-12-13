<table>
	<tr>
		<td colspan="1"></td>
		<td class="button">
			<a href="?p=viewBee&v=a" class="button">All</a>
		</td>
		<td class="button">
			<a href="?p=viewBee&v=b" class="button">Bred</a>
		</td>
		<td class="button">
			<a href="?p=viewBee&v=s" class="button">Sampled</a>
		</td>
	</tr>
	<?php
	$alphabetUpper = range('A', 'Z');
	$i = 0;
	$firstofthisletter = TRUE;
	foreach($beearr as $row) {
		if($row['bred'] == 1) {
			$bred = 'checked';
			$name = $row['name'];
		}
		else {
			$bred = '';
			$name = '<a href="http://bees.caraxian.com/bee/'.$row['name'].'" target="_blank">'.$row['name'].'</a>';
		}
		if($row['sampled'] == '1') {
			$sampled = 'checked';
		}
		else {
			$sampled = '';
		}
		$beeEffect = $row['effect'];
		$effectSearch = array_search($beeEffect, array_column($effectarr, 'id', 'effect'));
		if($effectSearch != '') {
			$effect = $effectSearch;
		}
		if($row['name'] != '') {
			Retry:
            //echo $alphabetUpper[$i];
            if (strtoupper(substr($row['name'], 0, 1)) == $alphabetUpper[$i]) {
                if ($firstofthisletter) {
                    echo "<th id=\"titles ".strtolower($alphabetUpper[$i])."\" colspan=\"4\">$alphabetUpper[$i]</th>\n\t";
                    echo "<tr id=\"titles\">\n\t\t<td>\n\t\t\tSpecies\n\t\t</td>\n\t\t<td>\n\t\t\tEffect\n\t\t</td>\n\t\t<td>\n\t\t\tBred\n\t\t</td>\n\t\t<td>\n\t\t\tSampled\n\t\t</td>\n\t</tr>\n";
                    $firstofthisletter = FALSE;
                }
                echo '<tr class="bees"><td>'.$name.'</td><td>'.$effect.'</td><td class="checkbox"><input type="checkbox" value="bred'.$row['id'].'" id="bred'.$row['id'].'" '.$bred.'></td><td class="checkbox"><input type="checkbox" value="sampled'.$row['id'].'" id="sampled'.$row['id'].'" '.$sampled.'></td></tr>';
            }
			else {
                $i++;
                $firstofthisletter = TRUE;
                goto Retry;
            }
		}
		// 	echo '<tr class="bees"><td>'.$name.'</td><td>'.$effect.'</td><td class="checkbox"><input type="checkbox" value="bred'.$row['id'].'" id="bred'.$row['id'].'" '.$bred.'></td><td class="checkbox"><input type="checkbox" value="sampled'.$row['id'].'" id="sampled'.$row['id'].'" '.$sampled.'></td></tr>';
		// }
		$effect = '';
	}
	?>
</table>
<script>
	$(":checkbox").on("click",function(){
		var i=$(this).attr("id").match(/\d+/);
		var v=$(this).attr("value");
		var a=v.split(/\d/).join('');
		if ($(this).is(":checked")) {
			//$(i).val(v);
			var c = "c";
			//alert('Checked');
		}
		else {
			//$(i).val(null);
			var c = "n";
			//alert('Not Checked');
		}
		var page = "process.php?id=";
		var urla = "&a=";
		var urlc = "&c=";
		var url = page + i + urla + a + urlc + c;
		$.get(url,function(data){
		   console.log(data);
		});
	});
</script>
