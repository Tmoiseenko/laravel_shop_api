<?php

namespace App\Orchid\Resources;

use App\Models\Post;
use App\Models\User;
use App\Orchid\Actions\CustomAction;
use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Sight;
use Orchid\Screen\TD;

class PostResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Post::class;

    public static function icon(): string
    {
        return 'note';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('title')
                ->title('Заголовок')
                ->placeholder('Enter title here'),
            Quill::make('text')
                ->title('Текст статьи')
                ->toolbar(["text", "color", "header", "list", "format", "media"]),
            Relation::make('user_id')
                ->fromModel(User::class, 'name')
                ->title('Выберите пользователя')
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', '#'),

            TD::make('title', 'Заголовок'),

            TD::make('created_at', 'Дата создания')
                ->render(function ($model) {
                    return $model->created_at->toDateTimeString();
                }),

            TD::make('updated_at', 'Дата обновление')
                ->render(function ($model) {
                    return $model->updated_at->toDateTimeString();
                }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('id'),
            Sight::make('title'),
            Sight::make('text'),
            Sight::make('user_id'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return __('Статьи');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel(): string
    {
        return __('Статью');
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(): array
    {
        return [
            CustomAction::class,
        ];
    }
}
