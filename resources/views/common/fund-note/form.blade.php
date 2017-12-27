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
        {{ Form::label('title_by', 'Created By :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('title_by', null, ['class' => 'form-control', 'placeholder' => 'Created By', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        {{ Form::label('title', 'Title :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) }}
        </div>
    </div>
</div>


<div class="box-body">
    <div class="form-group">
        {{ Form::label('description', 'Description :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) }}
        </div>
    </div>
</div>