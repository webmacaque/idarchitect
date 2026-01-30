@extends('layouts.admin')

@section('content')
    <div class="top">
        <span class="page-title">Панорамы</span>
        <button class="button" popovertarget="add-type-modal">Добавить</button>
    </div>

    @if($panoramas->isEmpty())
        <div class="panoramas-empty">
            <div class="panoramas-empty-icon">
                <img src="/admin/assets/svg/warning.svg" alt="warning" />
            </div>
            <p class="panoramas-empty__text">Нажмите 'Добавить' что бы<br>загрузить тур или панораму</p>
        </div>
    @else
        <div class="panoramas-list">
            @foreach($panoramas as $panorama)
                <div class="panorama-item">
                    <div class="panorama-item-preview">
                        @if($panorama->getPreviewImage())
                            <img src="{{ $panorama->getPreviewImage()->path }}" alt="preview" class="panorama-item__image" />
                        @else
                            <div class="panorama-item__no-image"></div>
                        @endif
                    </div>
                    <div class="panorama-item-info">
                        @if($panorama->isTour())
                            <span class="panorama-item__name">Тур "{{ $panorama->name }}"</span>
                        @else
                            <span class="panorama-item__name">{{ $panorama->getPreviewImage()->filename ?? 'Панорама' }}</span>
                        @endif
                    </div>
                    <div class="panorama-item-actions">
                        @if($panorama->isTour())
                            <a href="{{ route('admin-panoramas-edit', $panorama->id) }}" class="button square white" title="Редактировать">
                                <img src="/admin/assets/svg/edit.svg" alt="edit" />
                            </a>
                        @endif
                        <button type="button" class="button square white copy-link-btn" title="Копировать ссылку" data-url="{{ $panorama->isTour() ? route('panorama-tour', $panorama->public_hash) : route('panorama-single', $panorama->public_hash) }}">
                            <img src="/admin/assets/svg/copy.svg" alt="copy" />
                        </button>
                        <a href="#" class="button square white open-modal" title="Удалить" data-remove="{{ $panorama->id }}">
                            <img src="/admin/assets/svg/remove.svg" alt="remove" />
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div id="add-type-modal" class="modal" popover>
        <span class="modal__title">Что вы хотите добавить?</span>
        <div class="modal-type-buttons">
            <a href="{{ route('admin-panoramas-create-tour') }}" class="button white">Тур</a>
            <a href="{{ route('admin-panoramas-create-panorama') }}" class="button white">Панорама</a>
        </div>
    </div>
@endsection

@section('footer')
    @include('admin.delete-modal', [
        'title' => 'Удаление',
        'description' => 'Вы действительно хотите удалить выбранный элемент?',
        'action' => route('admin-panoramas-delete')
    ])
@endsection

@section('menu_panoramas', 'active')

@section('scripts')
@parent
<script>
document.querySelectorAll('.copy-link-btn').forEach(btn => {
    btn.addEventListener('click', async function() {
        const url = this.dataset.url;
        try {
            await navigator.clipboard.writeText(url);
            const originalTitle = this.title;
            this.title = 'Скопировано!';
            setTimeout(() => {
                this.title = originalTitle;
            }, 2000);
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    });
});
</script>
@endsection
