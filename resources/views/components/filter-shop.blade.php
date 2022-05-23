<aside class="w-3/5 bg-white h-full fixed z-30 max-w-xs overflow-scroll popup hidden">
    {{-- Close --}}
    <form method="GET" class="py-6 px-4">
        <div class="flex justify-end close cursor-pointer">
            <i class="fa-solid fa-xmark text-gray-400"></i>
        </div>

        <h1 class="uppercase font-bold mb-4">{{__('Filter')}}</h1>

        {{-- Categories --}}
        @foreach ($categories as $category)
        <div class="border-y filter-group py-4 toggle">
            <div class="name-filter parent-toggle cursor-pointer flex justify-between">
                <p>{{$category->name}}</p>
                <i class="fa-solid fa-angle-down block text-gray-500"></i>
            </div>

            {{-- Sub categories --}}
            <div class="filter-options child-toggle hidden">
                @foreach ($sub_categories as $sub_category)
                    @if ($sub_category->category_id === $category->id)
                        <div>
                            <input type="checkbox" name="sub-category[]" id="{{$sub_category->name}}" value="{{$sub_category->name}}"
                            @if (isset($selected))
                                @foreach ($selected as $selected_category)
                                    @if ($selected_category === $sub_category->name)
                                        checked
                                    @endif
                                @endforeach
                            @endif>

                            <label for="{{$sub_category->name}}">{{$sub_category->name}}</label>
                        </div>
                    @endif

                @endforeach

            </div>
        </div>
        @endforeach



        <div class="flex items-center justify-center mt-12">
            <x-button class="primair-btn">
                {{ __('Save') }}
            </x-button>
        </div>
    </form>


</aside>
