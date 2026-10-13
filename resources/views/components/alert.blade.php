
@if (session('success'))
    <div role="status"
         class="mb-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800">

        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5 text-green-700"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2.5"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 aria-hidden="true">
                <path d="m5 12 4 4L19 6"/>
            </svg>
        </div>

        <div class="flex-1">
            <p class="font-semibold">Berhasil</p>
            <p class="mt-1">{{ session('success') }}</p>
        </div>
    </div>
@endif

@if (session('error'))
    <div role="alert"
         class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800">

        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5 text-red-700"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 aria-hidden="true">
                <circle cx="12" cy="12" r="10"/>
                <path d="M12 8v4"/>
                <path d="M12 16h.01"/>
            </svg>
        </div>

        <div class="flex-1">
            <p class="font-semibold">Terjadi Kesalahan</p>
            <p class="mt-1">{{ session('error') }}</p>
        </div>
    </div>
@endif