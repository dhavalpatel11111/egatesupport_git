// $(document).ajaxStart(function() { Pace.restart(); });

$(document).ready(function() {

	window.setTimeout(function() {
		$(".alert-auto").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove();
		});
	}, 3000);

	$(".select2").select2();
	$(".colorpicker").colorpicker();

	$('.summernoteLarge').summernote({height: 400});
	$('.summernote').summernote({height: 200});


	// ISSUES BOARD HANDLER
	$(function () {
		//"use strict";
		//jQuery UI sortable for the todo list
		$(".todo-list").sortable({
		  placeholder: "sort-highlight",
	      connectWith: ".todo-list",
		  handle: ".handle",
		  forcePlaceholderSize: true,
		  zIndex: 999999,
	      update: function (event, ui) {
	          var issueid = ui.item.context.id;
	          //var newstatus = ui.item.context.closest('.todo-list').id;
			  var newstatus = ui.item.context.parentElement.id;
	          var formData = {updateIssueStatus:"",issueid:issueid,status:newstatus};
	          //alert(newstatus);
	          $.ajax({
	              data: formData,
	              type: 'POST',
	              url: 'ajax.php'
	          });

	      }
		});
	});


	// LOAD JQUERY KNOB
	$(function() {
		$(".knob").knob({
			draw : function () {
				// "tron" case
				if(this.$.data('skin') == 'tron') {

					var a = this.angle(this.cv)  // Angle
						, sa = this.startAngle          // Previous start angle
						, sat = this.startAngle         // Start angle
						, ea                            // Previous end angle
						, eat = sat + a                 // End angle
						, r = true;

					this.g.lineWidth = this.lineWidth;

					this.o.cursor
						&& (sat = eat - 0.3)
						&& (eat = eat + 0.3);

					if (this.o.displayPrevious) {
						ea = this.startAngle + this.angle(this.value);
						this.o.cursor
							&& (sa = ea - 0.3)
							&& (ea = ea + 0.3);
						this.g.beginPath();
						this.g.strokeStyle = this.previousColor;
						this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
						this.g.stroke();
					}

					this.g.beginPath();
					this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
					this.g.stroke();

					this.g.lineWidth = 2;
					this.g.beginPath();
					this.g.strokeStyle = this.o.fgColor;
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
					this.g.stroke();
					return false;
				}
			}
		});
	});
});




function showM(url) {
	
	$('#myModal .modal-content').empty();

	$('#myModal .modal-content').load(url);
	console.log("$('#myModal .modal-content')" , $('#myModal .modal-content').html());
	
	$('#myModal').modal('show');

}

function DeleteImageContarct(filename, dataId) {
    $.ajax({
        url: "index.php?route=contract/imagedelete&filename=" + filename + "&dataId=" + dataId,
        dataType: "json",
        data: { filename: filename, dataId: dataId },
        success: function(response) {
			var file = filename.substr(0, filename.lastIndexOf('.'));
			$('.usuageimageList_' + file).html('');
        },
        error: function(error) {
            console.error('Error: ', error);
        }
    });
}

// function DeleteImageContarctedit(filename, dataId) {
//     $.ajax({
//         url: "index.php?route=contract/contractimagedelete&filename=" + filename + "&dataId=" + dataId,
//         dataType: "json",
//         data: { filename: filename, dataId: dataId },
//         success: function(response) {
// 			var file = filename.substr(0, filename.lastIndexOf('.'));
// 			$('.usuageimageList_' + file).html('');
//         },
//         error: function(error) {
//             console.error('Error: ', error);
//         }
//     });
// }

function DeleteContarctRecord(id) {
	$.ajax({
        url: "index.php?route=contract/DeleteContarctRecord&id=" + id,
        dataType: "json",
        data: { id: id },
        success: function(response) {
			window.location.reload();
        },
        error: function(error) {
            console.error('Error: ', error);
        }
    });
}

function resizeIframe(obj) {
  obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}
