<?php

use function Livewire\Volt\{state};
use \App\Models\Memo;

state([
    'memos' => fn() => Memo::all(),
    'priority',
]);

$create =function() {
    return redirect()->route('memos.create');
};

?>

<div>
    <h1>タイトル一覧</h1>
    <ul>
        @foreach ($memos as $memo)
            <li>
                <a href="{{ route('memos.show', $memo->id) }}">
                    {{ $memo->title }}
                    @if ($memo->priority == '1')
                        <p>1:低</p>
                    @elseif ($memos.priority == '2')
                        <p>2:中</p>
                    @else
                        <p>3:高</p>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>

    <button wire:click="create">登録する</button>
</div>
