 {{-- awal modal Update Bio --}}
 <div wire:ignore.self class="modal fade modalImage" id="updateImage" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form>
                     <div class="form-group">
                         <label>Product Image</label>
                         <div class="custom-file">
                             <input style="cursor: pointer" type="file" wire:model="image" id="customFile"
                                 class="custom-file-input">
                             <label for="customFile" class="custom-file-label">Pilih Foto</label>
                             @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                         </div>
                         @if ($image)
                             <div class="row text-center">
                                 <div class="col ">
                                     <label class="mt-3">Foto</label><br>
                                     <img class="" src="{{ asset('storage/img-users/' . $user->image) }}" width="70%"
                                         class="img-fluid" alt="Preview">
                                 </div>
                                 <div class="col">
                                     <label class="mt-3">Preview</label><br>
                                     <img class="" src="{{ $image->temporaryUrl() }}" width="70%" class="img-fluid"
                                         alt="Preview">
                                 </div>
                             </div>
                         @else
                             <div class="row text-center">

                                 <div class="col ">

                                     <label class="mt-3">Foto</label><br>
                                     <img class="" src="{{ asset('storage/img-users/' . $user->image) }}" width="70%"
                                         class="img-fluid" alt="Preview">
                                 </div>
                                 <div class="col"></div>
                             </div>
                         @endif
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" wire:click.prevent="cancel()" class="genric-btn primary"
                     data-dismiss="modal">Close</button>
                 <button type="submit" wire:click.prevent="updateImage()" class="genric-btn danger"
                     data-dismiss="modal">Save Bio</button>
             </div>
         </div>
     </div>
 </div>
 {{-- akhir modal Bio --}}
