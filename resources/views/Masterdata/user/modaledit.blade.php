<div class="modal fade" id="modal-edit{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <p><b>Edit Identitas Pribadi</b></p>
                {!! Form::model($user, ['method' => 'patch', 'route' => ['user.update', $user->id]]) !!}
                <div class="mb-3">
                    {!! Form::label('Nama Lengkap', 'Nama Lengkap') !!}
                    {!! Form::text('nama_lengkap', $user->nama_lengkap, ['class' => 'form-control']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('username', 'Username') !!}
                    {!! Form::text('username', $user->username, ['class' => 'form-control']) !!}
                </div>
                <div>
                    {!! Form::label('Departemen', 'Departemen') !!}
                    <select class="form-control select2" style="width: 100%;" id="departemen_id" name="departemen_id"
                    required>
                    <option disabled bold value="departemen">departemen</option>
                    @foreach ($departemen as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->departemen }}</option>
                    @endforeach

                </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                    Cancel</button>
                {{ Form::button('<i class="fa fa-check-square-o"></i> Update', ['class' => 'btn btn-success', 'type' => 'submit']) }}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                {!! Form::model($user, ['method' => 'delete', 'route' => ['user.delete', $user->id]]) !!}
                <h4 class="text-center">Are you sure you want to delete user?</h4>
                <h5 class="text-center">Name: {{ $user->nama_lengkap }}</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                    Cancel</button>
                {{ Form::button('<i class="fa fa-trash"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit']) }}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
