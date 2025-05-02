<footer class="flex w-full items-center justify-between bg-transparent p-4 text-sm text-gray-500">
    <div class="flex cursor-default items-center text-lg">
        <span class="font-bold text-blue-400">C</span>
        <span class="font-bold text-red-400">R</span>
    </div>

    <div class="flex-1 text-center">
        <span><i class="fa-regular fa-copyright"></i> {{ date('Y') }} Cas Rovers. All rights reserved.</span>
    </div>

    <div class="socials flex gap-3">
        <a href="https://github.com/Cas-Rovers/" target="_blank"
            class="text-2xl transition-colors duration-300 hover:text-indigo-400"
            aria-label="{{ __('homepage.introduction.buttons.github.aria-label') }}">
            <i class="fa-brands fa-github"></i>
        </a>
        <a href="https://linkedin.com/in/casrovers/" target="_blank"
            class="text-2xl transition-colors duration-300 hover:text-indigo-400"
            aria-label="{{ __('homepage.introduction.buttons.linkedin.aria-label') }}">
            <i class="fa-brands fa-linkedin"></i>
        </a>
    </div>
</footer>
