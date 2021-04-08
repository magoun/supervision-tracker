<x-app-layout>
   <x-slot name="header">
         
      <h2 class="font-semibold text-xl text-gray-800 leading-tight align-middle">
         Edit Session
      </h2>

   </x-slot>

   <div class="min-h-screen bg-gray-100 py-6 flex flex-col sm:py-4">
      <div class="relative py-3 sm:max-w-xl sm:mx-auto">
         <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
            <div class="max-w-md mx-auto">
               <form method="POST" action={{ route('sessions.update', ['session' => $session->id]) }}>
                  @csrf
                  @method('PATCH')
                  <div class="divide-y divide-gray-200">
                     <div class="text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">

                        <div class="flex items-center space-x-4">
                           <div class="flex flex-col">
                              <label for="date" class="leading-loose">Date</label>
                              <div class="relative focus-within:text-gray-600 text-gray-400">
                                 <input name="date" type="date" value="{{ $session->date }}" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" required>
                              </div>
                           </div>
                           <div class="flex flex-col">
                              <label for="time" class="leading-loose">Time</label>
                              <div class="relative focus-within:text-gray-600 text-gray-400">
                                 <input name="time" type="time" value="{{ $session->time }}" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                              </div>
                           </div>
                           <div class="flex flex-col">
                              <label for="duration" class="leading-loose">Duration</label>
                              <div class="relative focus-within:text-gray-600 text-gray-400">
                                 <input name="duration" type="number" value="{{ $session->duration }}" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="60" required>
                              </div>
                           </div>
                        </div>
                        <div class="flex space-x-4">
                           <label class="inline-flex items-center">
                              <input type="radio" class="form-radio" name="isGroup" value=0 required {{ $session->isGroup ? '' : 'checked'}}>
                              <span class="ml-2">Individual</span>
                           </label>
                           <label class="inline-flex items-center ml-6">
                              <input type="radio" class="form-radio" name="isGroup" value=1 required {{ $session->isGroup ? 'checked' : ''}}>
                              <span class="ml-2">Group</span>
                           </label>
                        </div>
                        <div class="flex flex-col">
                           <label for="notes" class="leading-loose">Notes</label>
                           <textarea rows="5" name="notes" type="text" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Notes">{{ $session->notes }}</textarea>
                        </div>
                        <div class="flex flex-col">
                           <label for="tags" class="leading-loose">Tags</label>
                           <input name="tags" type="text" value="{{ $session->tags }}" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Optional">
                        </div>
                     </div>
                  
                     <div class="pt-4 flex items-center space-x-4">
                        <button type="button" onclick="window.location='{{ route('sessions.index') }}'" class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                           <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                           Cancel
                        </button>
                        <button type="submit" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">
                           Update
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
      
</x-app-layout>