<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

use App\Http\Forms\User as Forms;
use App\Services\UserService;

use MyCustom\Utils\Facades\Redirect;
use MyCustom\Utils\Facades\Text;

final class UserController extends Controller
{
	private UserService $service;

	function __construct()
	{
		$this->service = new UserService;
	}

	public function index(Request $request): View
	{
		$form = new Forms\IndexForm($request);

		$users = $this->service->getLowerThanRole($form);

		return view("user.index", compact("form", "users"));
	}

	public function createForm(): View
	{
		return view("user.create");
	}

	public function create(Request $request): RedirectResponse
	{
		$createResult = $this->service->create(new Forms\CreateForm($request));

		$redirectUtil = Redirect::route("user.index");

		return is_string($createResult)
			? $redirectUtil->dangerMessage(Text::failedText("user.create"), $createResult)->response
			: $redirectUtil->successMessage(Text::succeededText("user.create"))->response;
	}

	public function updateForm(int $id): View
	{
		return view("user.update", ["user" => $this->service->findById(new Forms\UpdatePreparationForm(compact("id")))]);
	}

	public function update(Request $request): RedirectResponse
	{
		$updateResult = $this->service->update(new Forms\UpdateForm($request));

		$redirectUtil = Redirect::route("user.index");

		return is_string($updateResult)
			? $redirectUtil->dangerMessage(Text::failedText("user.update"), $updateResult)->response
			: $redirectUtil->successMessage(Text::succeededText("user.update"))->response;
	}

	public function delete(Request $request): void
	{
		$this->service->delete(new Forms\DeleteForm($request));
	}

	public function changeIsValid(Request $request): void
	{
		$this->service->changeIsValid(new Forms\ChangeIsValidForm($request));
	}
}
