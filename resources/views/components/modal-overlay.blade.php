@props(['id', 'title', 'subtitle' => null])

<style>
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            backdrop-filter: blur(0px);
        }
        to {
            opacity: 1;
            backdrop-filter: blur(8px);
        }
    }
    
    @keyframes modalSlideUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .modal-overlay {
        animation: modalFadeIn 0.3s ease-out;
    }
    
    .modal-content {
        animation: modalSlideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
</style>

<!-- Modal Overlay with Glassmorphism -->
<div id="{{ $id }}" class="fixed inset-0 bg-midnight-950/80 z-50 hidden items-center justify-center p-4 modal-overlay backdrop-blur-md transition-all duration-300" style="display: none;" onclick="if(event.target === this) closeModal('{{ $id }}')">
    <div class="glass-panel rounded-3xl shadow-2xl max-w-md w-full relative max-h-[90vh] overflow-hidden flex flex-col modal-content mx-auto transform transition-all duration-300 border border-white/10" onclick="event.stopPropagation()">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-white/10 flex-shrink-0 bg-gradient-to-r from-white/5 to-transparent">
            <div class="flex justify-between items-start">
                <div class="flex-1 min-w-0 pr-4">
                    <h3 class="text-2xl font-display font-bold text-white">{{ $title }}</h3>
                    @if($subtitle)
                    <p class="text-sm text-gray-400 mt-1">{{ $subtitle }}</p>
                    @endif
                </div>
                <button type="button" onclick="closeModal('{{ $id }}')" class="text-gray-400 hover:text-white hover:bg-white/10 rounded-xl p-2 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-6 overflow-y-auto flex-1">
            {{ $slot }}
        </div>
    </div>
</div>
