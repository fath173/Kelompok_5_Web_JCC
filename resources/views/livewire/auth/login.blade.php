<div class="row pt-5">
  <div class="col-sm-12 col-md-6 offset-md-3">
    <div class="card card-custom">
      <div class="card-body">
        <h4 class="text-center">Login</h4>
        
        @if ($msg = session('message'))
          <div class="alert alert-{{ $msg['color'] }}" role="alert">{{ $msg['message'] }}</div>
        @endif
        <form wire:submit.prevent="submit">
          <div class="row">
            <div class="col-sm-12 form-group">
              <label>Email</label>
              <input type="text" wire:model.lazy="form.email" class="form-control" autocomplete="off">
              @error('form.email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-12 form-group">
              <label>Password</label>
              <input type="password" wire:model.lazy="form.password" class="form-control">
              @error('form.password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="col-sm-12 form-group">
              <button class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>