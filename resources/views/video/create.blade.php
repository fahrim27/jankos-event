<div class="modal-dialog" role="document">
    {!! Form::open(['url' => route('video.store'), 'method' => 'post' , 'files' => true]) !!}
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Tambah Sponsor</h5>
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
                {!! Form::label('category', 'Kategori') !!}
                <select class="form-control" required oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')" oninput="this.setCustomValidity('')" name="category">
                    <option value="1">Utama</option>
                    <option value="2">Sponsor/ Partner</option>
                </select>
            </div>
            <div class="form-group">
                {!! Form::label('link', 'Url') !!}
                {!! Form::text('link', null, ['class' => 'form-control', 'required', 'placeholder' => '']) !!}
            </div>
            <!--<div class="form-group">-->
            <!--    {!! Form::label('video', 'Video') !!}-->
            <!--    {!! Form::file('video', ['class' => 'form-control', 'required']) !!}-->
            <!--</div>-->
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>