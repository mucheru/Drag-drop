 <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#padding-item-drop, #complete-item-drop" ).sortable({
      connectWith: ".connectedSortable",
      opacity: 0.5,
    });
    $( ".connectedSortable" ).on( "sortupdate", function( event, ui ) {
        var pending = [];
        var accept = [];
        $("#padding-item-drop li").each(function( index ) {
          if($(this).attr('item-id')){
            pending[index] = $(this).attr('item-id');
          }
        });
        $("#complete-item-drop li").each(function( index ) {
          accept[index] = $(this).attr('item-id');
        });
        $.ajax({
            url: "{{ route('update.items') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {pending:pending,accept:accept},
            success: function(data) {
              console.log('success');
            }
        });
          
    });
  });
</script>
