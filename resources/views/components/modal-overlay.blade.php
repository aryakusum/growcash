@props(['id', 'title', 'subtitle' => null])

<style>
    @keyframes modalFadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes modalSlideUp {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .modal-overlay {
        animation: modalFadeIn 0.2s ease-out;
    }
    
    .modal-content {
        animation: modalSlideUp 0.3s ease-out;
    }
</style>

<!-- Modal Overlay -->
<div id="{{ $id }}" class="fixed inset-0 bg-gray-400 bg-opacity-5 z-50 hidden items-center justify-center p-3 sm:p-4 modal-overlay" style="display: none; backdrop-filter: blur(1px); -webkit-backdrop-filter: blur(1px);" onclick="if(event.target === this) closeModal('{{ $id }}')">
    <div class="bg-white/95 backdrop-blur-md rounded-[28px] sm:rounded-[34px] shadow-[0_24px_60px_rgba(15,23,42,0.16)] max-w-md w-full relative max-h-[90vh] sm:max-h-[88vh] overflow-hidden flex flex-col modal-content mx-auto border border-white/40" onclick="event.stopPropagation()" style="transition: transform 0.25s ease; transform-origin: center;">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-white/10 bg-gradient-to-r from-blue-600 via-indigo-500 to-blue-500 flex-shrink-0 shadow-inner rounded-t-[32px] sm:rounded-t-[38px]">
            <div class="flex justify-between items-center">
                <div class="flex-1 min-w-0 pr-4">
                    <h3 class="text-lg font-bold text-white mb-0.5">{{ $title }}</h3>
                    @if($subtitle)
                    <p class="text-sm text-white/80 leading-relaxed mt-1">{{ $subtitle }}</p>
                    @endif
                </div>
                <button type="button" onclick="closeModal('{{ $id }}')" class="ml-2 text-white/80 hover:text-white hover:bg-white/20 rounded-full p-2 flex-shrink-0 transition-all duration-200 hover:rotate-90">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-6 overflow-y-auto flex-1 bg-white/95" style="scrollbar-width: thin; scrollbar-color: #cbd5e0 #f1f5f9;">
            {{ $slot }}
        </div>
    </div>
</div>

