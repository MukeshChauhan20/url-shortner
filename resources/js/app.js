import './bootstrap';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});  

(() => {
    $(document).on('click','.order-now',function(){
        let $this = $(this);
        $this.prop('disabled',true).text('Please Wait..');
        $.ajax({
            url: 'url/update-plans',
            data : {'package':$this.data('package')},
            method: 'post',
            dataType : 'json',
            success : function(resp){
                if(resp.status){
                    window.location.reload();
                }else{
                    $this.prop('disabled',false).text('Order Now');
                }
            },
            error : function(jqXHR){     
                $this.prop('disabled',false).text('Order Now');
            }
        });
    });

    $(document).on('click','.create-url',function(){
        let $this = $(this);
        $this.prop('disabled',true).text('Please Wait..');

        if($('#url').val() == '' || $('#url').val() == null){
            alert('Enter Url');
            return false;
        }

        $.ajax({
            url: $('#frmShortner').attr('action'),
            data : {'url':$('#url').val(),'status':$('#status').prop('checked')},
            method: 'post',
            dataType : 'json',
            success : function(resp){
                $this.prop('disable',false).text('Create');
                if(resp.status){
                    window.location.reload();
                    $('#url').val('');
                    $('.btn-close').click();
                }else{
                    $('.alert').text(resp.message).show();
                }
            },
            error : function(jqXHR){     
                $this.prop('disabled',false).text('Create');
                $('#url').val('');
                alert(jqXHR.responseJSON.message);
            }
        });
    });

    
    $(document).on('click','.remove-url',function(){
        if (!confirm('Are you sure you want to remove?')) {
            return;
        }
        let $this = $(this);
        $this.prop('disabled',true).text('Please Wait..');
        $.ajax({
            url: $this.data('action'),
            method: 'get',
            dataType : 'json',
            success : function(resp){
                window.location.reload();
            },
            error : function(jqXHR){     
                alert(jqXHR.responseJSON.message);
                window.location.reload();
            }
        });
    });
    

    $(document).on('click','.edit-url',function(){
        let $this = $(this);
        $('#create-modal').find('.create-url').text('Update');
        $.ajax({
            url: $this.data('action'),
            method: 'get',
            dataType : 'json',
            success : function(resp){
                $('#url').val(resp.data.orgUrl);
                $('#status').prop('checked',resp.data.status);
                $('#create-modal').find('form').attr('action',$this.data('form_action'));
            },
            error : function(jqXHR){     
                alert(jqXHR.responseJSON.message);
                window.location.reload();
            }
        });
    });

    var myModalEl = document.getElementById('create-modal')
    myModalEl.addEventListener('hidden.bs.modal', function (event) {    
        $('#url').val('');
        $('#status').prop('checked',false);
        $('#create-modal').find('.create-url').text('Create');
    });
})()