<?php
	$basePath=Yii::getPathOfAlias('application.modules.message.views.asset');
	$baseUrl=Yii::app()->getAssetManager()->publish($basePath);
	$cs = Yii::app()->getClientScript();
	$cs->registerCoreScript('jquery');
	$cs->registerCssFile($baseUrl.'/css/redmond/jquery-ui-1.8.16.custom.css');
	$cs->registerCssFile($baseUrl.'/css/styles.css');
	$cs->registerScriptFile($baseUrl.'/js/jquery-ui-1.8.16.custom.min.js');
?>

<script type="text/javascript">
	$(document).ready(function() {
                function split( val ) {
                        return val.split( /,\s*/ );
                }
                function extractLast( term ) {
                        return split( term ).pop();
                }
		$( "#receiver" ).bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			}).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "<?php echo $this->createUrl('suggest/user') ?>",
					dataType: "jsonp",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: extractLast( request.term )
					},

					success: function(data) {
						response($.map(data.users, function(user) {
							return {
								label: user.name,
								value: user.id
							}
						}));
					}
				});
			},
			minLength: 2,
			mustMatch: true,
			focus: function(event, ui) {
//				$('#receiver').val(ui.item.label);
				return false;
			},
                        select: function( event, ui ) {
                                var terms = split( this.value );
                                var ids = split( $('#Message_receiver_id').val() );
                                var xx = $('#Message_receiver_id').val();
                                // remove the current input
                                terms.pop();
                                // add the selected item
                                terms.push( ui.item.label );
                                ids.push( ui.item.value );
                                // add placeholder to get the comma-and-space at the end
                                terms.push( "" );
                                this.value = terms.join( "," );
                                if(xx == ''){
                                    $('#Message_receiver_id').val(ui.item.value);
                                }
                                else{
                                    $('#Message_receiver_id').val(ids.join( "," ));
                                }
                                return false;
                        }
//			select: function(event, ui) {
//				$('#receiver').val(ui.item.label);
//				$('#Message_receiver_id').val(ui.item.value);
//				return false;
//			},
//			open: function() {
//				$(this).removeClass("ui-corner-all").addClass("ui-corner-top");
//			},
//			close: function() {
//				$(this).removeClass("ui-corner-top").addClass("ui-corner-all");
//			}
		});
	});
</script>
