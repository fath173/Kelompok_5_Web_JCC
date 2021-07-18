 {{-- awal modal Update Bio --}}
 <div wire:ignore.self class="modal fade modalBio" id="updateBio" tabindex="-1" role="dialog"
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
                         <input type="hidden" wire:model="user_id">
                         <label for="exampleFormControlInput1">Nama</label>
                         <input type="text" class="form-control" wire:model="name" id="exampleFormControlInput1"
                             placeholder="Enter Name" required>
                         @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     {{-- <div class="form-group">
                         <label for="exampleFormControlInput2">Username</label>
                         <input type="email" class="form-control" wire:model="username" id="exampleFormControlInput2"
                             placeholder="Enter Username" required>
                         @error('username') <span class="text-danger">{{ $message }}</span>@enderror
                     </div> --}}
                     <div class="form-group">
                         <label for="exampleFormControlInput2">Tanggal Lahir</label>
                         <input type="email" class="form-control" wire:model="birthday" id="exampleFormControlInput2"
                             placeholder="Enter hp" required>
                         @error('birthday') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                     <div class="form-group">
                         <label for="exampleFormControlInput2">Jenis Kelamin</label>
                         <select class="form-control" wire:model="gender" required>
                             <option value="{{ $user->gender }}" disabled>{{ $user->gender }}
                             </option>
                             <option value="pria">Pria</option>
                             <option value="wanita">Wanita</option>
                         </select>
                         @error('gender') <span class="text-danger">{{ $message }}</span>@enderror
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" wire:click="cancel()" class="genric-btn primary"
                     data-dismiss="modal">Close</button>
                 <button type="button" wire:click="updateBio()" class="genric-btn danger">Save
                     Bio</button>
             </div>
         </div>
     </div>
 </div>
 {{-- akhir modal Bio --}}
