<div x-data="{ show: true }" class="relative">
    <input 
        id="password" 
        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-custom-blue bg-transparent rounded-lg border border-custom-blue appearance-none text-custom-blue focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-500 peer" 
        :type="show ? 'password' : 'text'" 
        name="password" 
        required 
        autocomplete="new-password" 
        placeholder=" " 
    />
    <x-input-label 
        for="password" 
        :value="__('Password')" 
        class="absolute text-sm text-custom-blue duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-custom-white px-2 peer-focus:px-2 peer-focus:text-custom-blue peer-focus: peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1" 
    />
    

    <div class="absolute inset-y-0 end-0 flex items-center pr-3 cursor-pointer">
        <svg 
            class="h-6 text-custom-blue" 
            fill="none" 
            @click="show = !show" 
            :class="{'hidden': !show, 'block':show }" 
            xmlns="http://www.w3.org/2000/svg" 
            viewbox="0 0 576 512"
        >
            <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path>
        </svg>
        <svg 
            class="h-6 text-custom-blue" 
            fill="none" 
            @click="show = !show" 
            :class="{'block': !show, 'hidden':show }" 
            xmlns="http://www.w3.org/2000/svg" 
            viewbox="0 0 640 512"
        >
            <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45z"></path>
        </svg>
    </div>
</div>