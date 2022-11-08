{!! Form::open([ 'method'=>'PATCH', 'route' => ['admin.stocks.update',$stock->id], 'files' => true,'id'=>'stockForm']) !!}
@csrf
<div class="form-row">
    <div class="col-12 col-md-6 mb-3">
        <label for="name">Quantity</label>
        <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Quantity" value="{{ $stock->quantity }}" required="">
    </div>
    
</div>
<a href="javascript:;" onclick="updateStock('{{ route('admin.stocks.update',$stock->id) }}')" class="btn btn-success ml-1">Save<i class="material-icons">save</i></a>
{!! Form::close() !!}