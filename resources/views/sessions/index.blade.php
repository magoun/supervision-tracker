<x-app-layout>
   <x-slot name="header">
      <div class="flex justify-between items-center">
         
         <h2 class="font-semibold text-xl text-gray-800 leading-tight align-middle">
            Sessions
         </h2>

         <form action={{ route('sessions.create') }}>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
               + Session
            </button>
         </form>

      </div>
   </x-slot>

   <div class="bg-white pb-4 px-4 rounded-md w-full">
      <div class="overflow-x-auto mt-6">

         <table class="table-auto border-collapse w-full">
            <thead>
               <tr class="rounded-lg text-sm font-medium text-gray-700 text-center border-b border-gray-400" style="font-size: 0.9674rem">
                  <th class="px-2 py-2 ">Date</th>
                  <th class="px-2 py-2 ">Duration</th>
                  <th class="px-2 py-2 ">Group?</th>
                  <th class="px-2 py-2 ">Actions</th>
               </tr>
            </thead>
            <tbody class="text-sm font-normal text-gray-700">
               
               @foreach ($sessions as $session)
                  <tr class="hover:bg-gray-100 border-b text-center border-gray-200 py-10">
                     <td class="px-2 py-4">{{ $session->date }}</td>
                     <td class="px-2 py-4">{{ $session->duration }}</td>
                     <td class="px-2 py-4">{{ $session->isGroup ? 'Yes' : 'No' }}</td>
                     <td class="px-2 py-4">
                        <div class="flex justify-evenly">
                           <a href={{ route('sessions.edit', ['session' => $session->id]) }} class="text-green-600">
                              <i class="fas fa-pencil-alt p-2"></i>
                           </a>
                           <form action={{ route('sessions.destroy', ['session' => $session->id]) }} method="POST" >
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="text-red-600">
                                 <i class="fas fa-trash-alt p-2"></i>
                              </button>
                           </form>
                        </div>
                     </td>
                  </tr>
               @endforeach
               
            </tbody>
         </table>
      </div>
   </div>

</x-app-layout>