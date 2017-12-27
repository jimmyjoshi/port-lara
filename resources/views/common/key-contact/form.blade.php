<div class="box-body">
    <div class="form-group">
        {{ Form::label('fund_id', 'Select Fund :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::select('fund_id', ['' => 'Select Fund'] + $entities, null, ['class' => 'form-control', 'required' => 'required']) }}
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
        {{ Form::label('designation', 'Designation :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('designation', null, ['class' => 'form-control', 'placeholder' => 'Designation', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('contact_number', 'Contact Number :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('contact_number', null, ['class' => 'form-control', 'placeholder' => 'Contact Number' ]) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('email_id', 'Email Id :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::email('email_id', null, ['class' => 'form-control', 'placeholder' => 'Email Id']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('description', 'Description :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'required' => 'required']) }}
        </div>
    </div>
</div>
