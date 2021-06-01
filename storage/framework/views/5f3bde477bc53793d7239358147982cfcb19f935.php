
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>jQuery UI Draggable - Default functionality-codecheef.org</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style>
    #draggable { 
        width: 150px;
        height: 150px;
        padding: 0.5em;
    }
  </style>
</head>
<body class="bg-light">
<div class="container">
  <div class="row">
    <div class="col-md-12">
        <h2 class="text-center pb-3 pt-1">Learning drag and dropable - CodeCheef</h2>
        <div class="row">
            <div class="col-md-5 p-3 bg-dark offset-md-1">
                <ul class="list-group shadow-lg connectedSortable" id="padding-item-drop">
                  <?php if(!empty($panddingItem) && $panddingItem->count()): ?>
                    <?php $__currentLoopData = $panddingItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="list-group-item" item-id="<?php echo e($value->id); ?>"><?php echo e($value->title); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-5 p-3 bg-dark offset-md-1 shadow-lg complete-item">
                <ul class="list-group  connectedSortable" id="complete-item-drop">
                  <?php if(!empty($completeItem) && $completeItem->count()): ?>
                    <?php $__currentLoopData = $completeItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="list-group-item " item-id="<?php echo e($value->id); ?>"><?php echo e($value->title); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
  </div>
</div>
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
            url: "<?php echo e(route('update.items')); ?>",
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
</body>
</html> <?php /**PATH /home/steve/drag-drop/resources/views/test.blade.php ENDPATH**/ ?>