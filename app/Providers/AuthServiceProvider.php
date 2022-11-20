<?php

namespace App\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider {
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot() {
		Passport::routes();
		$this->registerPolicies();
		$this->registerAdminPolicies();
		$this->registerCategoryPolicies();
		$this->registerMenuPolicies();
		$this->registerUserPolicies();
		$this->registerProductPolicies();
		$this->registerProductImagePolicies();
		$this->registerItemPolicies();
		$this->registerSlidePolicies();
		$this->registerBanerPolicies();
		$this->registerMessagePolicies();
		$this->registerCommentPolicies();
		$this->registerSettingPolicies();
		$this->registerVisitorPolicies();
		$this->registerDepotPolicies();
		$this->registerPostPolicies();
		$this->registerCodePolicies();
		$this->registerOrderPolicies();
		$this->registerCheckoutPolicies();
		$this->registerWidgetPolicies();
		//
	}
	public function registerAdminPolicies() {
		Gate::define('admin-panel', function ($user) {
				return $user->hasAccess(['admin-panel']);
			});
	}
	public function registerVisitorPolicies() {
		Gate::define('see-visitor', function ($user) {
				return $user->hasAccess(['see-visitor']);
			});
		Gate::define('visitor', function ($user) {
				return $user->hasAccess(['visitor']);
			});
	}
	public function registerPostPolicies() {
		Gate::define('see-post', function ($user) {
				return $user->hasAccess(['see-post']);
			});
		Gate::define('create-post', function ($user) {
				return $user->hasAccess(['create-post']);
			});
		Gate::define('delete-post', function ($user) {
				return $user->hasAccess(['delete-post']);
			});
	}
	public function registerDepotPolicies() {
		Gate::define('see-depot', function ($user) {
				return $user->hasAccess(['see-depot']);
			});
	}
	public function registerCodePolicies() {
		Gate::define('see-codes', function ($user) {
				return $user->hasAccess(['see-codes']);
			});
	}
	public function registerMenuPolicies() {
		Gate::define('see-menu', function ($user) {
				return $user->hasAccess(['see-menu']);
			});
		Gate::define('create-menu', function ($user) {
				return $user->hasAccess(['create-menu']);
			});
		Gate::define('edit-menu', function ($user) {
				return $user->hasAccess(['edit-menu']);
			});
		Gate::define('remove-menu', function ($user) {
				return $user->hasAccess(['remove-menu']);
			});
	}
	public function registerCategoryPolicies() {
		Gate::define('see-category', function ($user) {
				return $user->hasAccess(['see-category']);
			});
		Gate::define('create-category', function ($user) {
				return $user->hasAccess(['create-category']);
			});
		Gate::define('edit-category', function ($user) {
				return $user->hasAccess(['edit-category']);
			});
		Gate::define('remove-category', function ($user) {
				return $user->hasAccess(['remove-category']);
			});
	}
	public function registerUserPolicies() {
		Gate::define('see-user', function ($user) {
				return $user->hasAccess(['see-user']);
			});
		Gate::define('see-user-details', function ($user) {
				return $user->hasAccess(['see-user-details']);
			});
		Gate::define('remove-user', function ($user) {
				return $user->hasAccess(['remove-user']);
			});
	}
	public function registerProductPolicies() {
		Gate::define('see-product', function ($user) {
				return $user->hasAccess(['see-product']);
			});
		Gate::define('create-product', function ($user) {
				return $user->hasAccess(['create-product']);
			});
		Gate::define('edit-product', function ($user) {
				return $user->hasAccess(['edit-product']);
			});
		Gate::define('remove-product', function ($user) {
				return $user->hasAccess(['remove-product']);
			});
	}
	public function registerItemPolicies() {
		Gate::define('see-item', function ($user) {
				return $user->hasAccess(['see-item']);
			});
		Gate::define('create-item', function ($user) {
				return $user->hasAccess(['create-item']);
			});
		Gate::define('edit-item', function ($user) {
				return $user->hasAccess(['edit-item']);
			});
		Gate::define('remove-item', function ($user) {
				return $user->hasAccess(['remove-item']);
			});
	}
	public function registerSlidePolicies() {
		Gate::define('see-slide', function ($user) {
				return $user->hasAccess(['see-slide']);
			});
		Gate::define('create-slide', function ($user) {
				return $user->hasAccess(['create-slide']);
			});
		Gate::define('edit-slide', function ($user) {
				return $user->hasAccess(['edit-slide']);
			});
		Gate::define('remove-slide', function ($user) {
				return $user->hasAccess(['remove-slide']);
			});
	}
	public function registerBanerPolicies() {
		Gate::define('see-baner', function ($user) {
				return $user->hasAccess(['see-baner']);
			});
		Gate::define('create-baner', function ($user) {
				return $user->hasAccess(['create-baner']);
			});
		Gate::define('edit-baner', function ($user) {
				return $user->hasAccess(['edit-baner']);
			});
	}
	public function registerMessagePolicies() {
		Gate::define('see-message', function ($user) {
				return $user->hasAccess(['see-message']);
			});
		Gate::define('create-message', function ($user) {
				return $user->hasAccess(['create-message']);
			});
	}
	public function registerCommentPolicies() {
		Gate::define('see-comment', function ($user) {
				return $user->hasAccess(['see-comment']);
			});
		Gate::define('create-comment', function ($user) {
				return $user->hasAccess(['create-comment']);
			});
	}
	public function registerSettingPolicies() {
		Gate::define('see-setting', function ($user) {
				return $user->hasAccess(['see-setting']);
			});
	}
	public function registerProductImagePolicies() {
		Gate::define('see-product-image', function ($user) {
				return $user->hasAccess(['see-product-image']);
			});
		Gate::define('edit-product-image', function ($user) {
				return $user->hasAccess(['edit-product-image']);
			});
		Gate::define('remove-product-image', function ($user) {
				return $user->hasAccess(['remove-product-image']);
			});
	}

	public function registerOrderPolicies() {
		Gate::define('see-order', function ($user) {
				return $user->hasAccess(['see-order']);
			});
	}

	public function registerCheckoutPolicies() {
		Gate::define('see-checkout', function ($user) {
				return $user->hasAccess(['see-checkout']);
			});
	}

	public function registerWidgetPolicies() {
		Gate::define('see-widget', function ($user) {
				return $user->hasAccess(['see-widget']);
			});
	}
}
