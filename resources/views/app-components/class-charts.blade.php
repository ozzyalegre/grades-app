<div class="grid sm:grid-cols-4 gap-3">
    @foreach ($subjects as $item)
        <div class="mt-4 justify-normal bg-white overflow-hidden shadow-md rounded-md py-8">
            <livewire:class-grade-history :class_name="$item->name" :term_id="$current_term->id" :subject_id="$item->id">
        </div>  
    @endforeach
</div>
