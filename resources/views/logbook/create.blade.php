<div class="modal-dialog modal-lg" role="document">
    {!! Form::open(['url' => route('logbooks.store'), 'method' => 'post', 'files' => true]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Logbook</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <a href="javascript: void(0);">
                    <img id="preview-image-before-upload" src="{{ asset('images/profile.png') }}" class="rounded mr-75" alt="profile image" height="64" width="64">
                </a>
                <div class="media-body mt-75">
                    <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                        <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Upload new photo</label>
                        <input type="file" name="image" id="account-upload" hidden="">
                    </div>
                    <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG.</small></p>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Judul') !!}
                {!! Form::text('title', null, ['class' => 'form-control', 'required', 'placeholder' => '', 'oninvalid' => "this.setCustomValidity('Mohon diisi dengan lengkap')", 'oninput' => "this.setCustomValidity('')"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Deskripsi') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<script>
    CKEDITOR.replace('description');

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