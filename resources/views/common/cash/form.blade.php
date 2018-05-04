
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
        {{ Form::label('cash_type', 'Entry Type :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::select('cash_type', ['CREDIT' => 'Credit', 'DEBIT' => 'Debit'], (isset($item) && isset($item->cash_type)) ? $item->cash_type : 'CREDIT', ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>


<div class="box-body">
    <div class="form-group">
        {{ Form::label('amount', 'Amount :', ['class' => 'col-lg-2 control-label']) }}

        <div class="col-lg-10">
            {{ Form::number('amount', null, ['min' => "0.0", 'step' => "0.1", 'class' => 'form-control', 'placeholder' => 'Amount', 'required' => 'required']) }}
        </div>
    </div>
</div>