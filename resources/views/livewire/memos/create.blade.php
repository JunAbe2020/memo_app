<?php

use function Livewire\Volt\{state, rules};
use App\Models\Memo;

state([
    'title',
    'body', 
    'priority' => 1
]);

// バリデーションルールを定義
rules([
    'title' => 'required|string|max:50',
    'body' => 'required|string|max:2000',
    'priority' => 'required|integer|min:1|max:3',
]);

// メモを保管する関数
$store = function() {
    $this->validate();
    Memo::create([
        'title' => $this->title,
        'body' => $this->body,
        'priority' => $this->priority,
    ]);
    // 一覧ページにリダイレクト
    return redirect()->route('memos.index');
};

?>

<div>
    <a href="{{ route('memos.index') }}">戻る</a>
    <h1>新規登録</h1>
    <form wire:submit="store">
        <p>
            <label for="title">タイトル</label>
            @error('title')
                <span class="error">({{ $message }})</span>
            @enderror
            <br>
            <input type="text" wire:model="title" id="title">
        </p>
        <p>
            <label for="body">本文</label>
            @error('body')
                <span class="error">({{ $message }})</span>
            @enderror
            <br>
            <textarea wire:model="body" id="body"></textarea>
        </p>
        <p>
            <select for="priority">
                <option value="1" wire:model="priority" id="1">低</option>
                <option value="2" wire:model="priority" id="2">中</option>
                <option value="3" wire:model="priority" id="3">高</option>
            </select>
        </p>
        <button type="submit">登録</button>
    </form>
</div>
