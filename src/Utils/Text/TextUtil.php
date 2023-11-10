<?php

namespace MyCustom\Utils\Text;

use MyCustom\Jsonables\BaseJsonable;

final class TextUtil extends BaseJsonable
{
    public readonly string $textKey;
    public readonly array $replaces;

    function __construct(string $textKey, array $replaces)
    {
        $this->textKey  = $textKey;
        $this->replaces = $replaces;
    }

    /**
     * テキストを取得する
     *
     * @return string
     */
    public function text(): string
    {
        return ___($this->textKey, $this->replaces);
    }

    /**
     * textKey を作成したことを表すテキストを取得する
     *
     * @return string
     */
    public function createdText(): string
    {
        return ___("mycustom.message.created", ["target" => $this->text(), "create" => ___("mycustom.word.create")]);
    }

    /**
     * textKey を更新したことを表すテキストを取得する
     *
     * @return string
     */
    public function updatedText(): string
    {
        return ___("mycustom.message.updated", ["target" => $this->text(), "update" => ___("mycustom.word.update")]);
    }


    /**
     * textKey を削除したことを表すテキストを取得する
     *
     * @return string
     */
    public function deletedText(): string
    {
        return ___("mycustom.message.deleted", ["target" => $this->text(), "delete" => ___("mycustom.word.delete")]);
    }


    /**
     * textKey が成功したことを表すテキストを取得する
     *
     * @return string
     */
    public function succeededText(): string
    {
        return ___("mycustom.message.succeeded", ["target" => $this->text(), "success" => ___("mycustom.word.success")]);
    }


    /**
     * textKey が失敗したことを表すテキストを取得する
     *
     * @return string
     */
    public function failedText(): string
    {
        return ___("mycustom.message.failed", ["target" => $this->text(), "failure" => ___("mycustom.word.failure")]);
    }

    /**
     * textKey の作成に成功したことを示すテキストを取得する
     *
     * @return string
     */
    public function createSucceededText(): string
    {
        return ___("mycustom.message.create_succeeded", ["target" => $this->text(), "create" => ___("mycustom.word.create"), "success" => ___("mycustom.word.success")]);
    }

    /**
     * textKey の作成に失敗したことを示すテキストを取得する
     *
     * @return string
     */
    public function createFailedText(): string
    {
        return ___("mycustom.message.create_failed", ["target" => $this->text(), "create" => ___("mycustom.word.create"), "failure" => ___("mycustom.word.failure")]);
    }

    /**
     * textKey の更新に成功したことを示すテキストを取得する
     *
     * @return string
     */
    public function updateSucceededText(): string
    {
        return ___("mycustom.message.update_succeeded", ["target" => $this->text(), "update" => ___("mycustom.word.update"), "success" => ___("mycustom.word.success")]);
    }

    /**
     * textKey の更新に失敗したことを示すテキストを取得する
     *
     * @return string
     */
    public function updateFailedText(): string
    {
        return ___("mycustom.message.update_failed", ["target" => $this->text(), "update" => ___("mycustom.word.update"), "failure" => ___("mycustom.word.failure")]);
    }

    /**
     * textKey の削除に成功したことを示すテキストを取得する
     *
     * @return string
     */
    public function deleteSucceededText(): string
    {
        return ___("mycustom.message.delete_succeeded", ["target" => $this->text(), "delete" => ___("mycustom.word.delete"), "success" => ___("mycustom.word.success")]);
    }

    /**
     * textKey の削除に失敗したことを示すテキストを取得する
     *
     * @return string
     */
    public function deleteFailedText(): string
    {
        return ___("mycustom.message.delete_failed", ["target" => $this->text(), "delete" => ___("mycustom.word.delete"), "failure" => ___("mycustom.word.failure")]);
    }
}
