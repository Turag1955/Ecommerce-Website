
   function get_sub_category(sub_cat_id){
       var category_id = jQuery('#sub_category').val();
      jQuery.ajax({
          url: 'get_sub_category.php',
          type: 'post',
          data: 'category_id='+category_id+'&sub_cat_id='+sub_cat_id,
          success: function(result){
              jQuery('#sub_get_category').html(result);
          }
      });
   }
