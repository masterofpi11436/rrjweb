<?php

namespace App\Http\Controllers\Policy;

use App\Http\Controllers\Controller;
use App\Models\Policy\PolicyBuilder;

class BuilderController extends Controller
{
    public function index()
    {
        return view('Policy.Builder.builder.index');
    }

    public function create()
    {
        return view('Policy.Builder.builder.create');
    }

    public function edit($id)
    {
        return view('Policy.Builder.builder.edit', [
            'policyBuilderId' => $id,
        ]);
    }

    public function destroy($id)
    {
        $policy = PolicyBuilder::findOrFail($id);

        $policy->delete();

        return redirect()
            ->route('policy.builder.index')
            ->with('success', 'Policy deleted successfully.');
    }
}
