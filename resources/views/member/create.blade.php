<div class="modal-dialog modal-lg" role="document">
    {!! Form::open(['url' => route('members.store'), 'method' => 'post', 'files' => true]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('name', 'Nama') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => '', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('address', 'Alamat') !!}
                {!! Form::text('address', null, ['class' => 'form-control', 'required', 'placeholder' => '', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('phone', 'Telpon/ Whatsapp') !!}
                {!! Form::text('phone', null, ['class' => 'form-control', 'required', 'placeholder' => '', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    CKEDITOR.replace('content');

    $(document).ready(function (e) {
       $('#account-upload').change(function(){
               
        let reader = new FileReader();
        reader.onload = (e) => { 

          $('#preview-image-before-upload').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
      
       });
    });
</script>