<div class="box-body">
    <div class="form-group">
        {{ Form::label('user_id', 'Select User :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::select('user_id', $users, null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('company_id', 'Select Company :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::select('company_id', ['' => 'Select Company'] + $companies, null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>


<div class="box-body">
    <div class="form-group">
        {{ Form::label('title', 'Name :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('notes', 'Description :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => 'Description', 'required' => 'required']) }}
        </div>
    </div>
</div>