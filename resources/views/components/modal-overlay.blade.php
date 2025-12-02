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
<div id="{{ $id }}" class="fixed inset-0 bg-gray-900/60 z-50 hidden items-center justify-center p-4 modal-overlay backdrop-blur-sm transition-all duration-300" style="display: none;" onclick="if(event.target === this) closeModal('{{ $id }}')">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full relative max-h-[90vh] overflow-hidden flex flex-col modal-content mx-auto transform transition-all duration-300 scale-95 opacity-0" onclick="event.stopPropagation()">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-gray-100 bg-white flex-shrink-0">
            <div class="flex justify-between items-start">
                <div class="flex-1 min-w-0 pr-4">
                    <h3 class="text-xl font-bold text-gray-900">{{ $title }}</h3>
                    @if($subtitle)
                    <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
                    @endif
                </div>
                <button type="button" onclick="closeModal('{{ $id }}')" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-6 overflow-y-auto flex-1 bg-white">
            {{ $slot }}
        </div>
    </div>
</div>

