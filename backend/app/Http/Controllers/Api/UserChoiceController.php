<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserChoiceRequest;
use App\Http\Requests\ResetUserChoicesRequest;
use App\Models\UserChoice;
use App\Exceptions\ApiException;
use App\Traits\JsonResponseTrait;

class UserChoiceController extends Controller
{
    use JsonResponseTrait;

    public function store(UserChoiceRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $userChoice = UserChoice::create([
                'user_id' => $validated['user_id'],
                'choice_id' => $validated['choice_id']
            ]);

            return $this->successResponse(
                $userChoice,
                'Choice saved successfully',
                201
            );
        } catch (\Exception $e) {
            throw new ApiException('Failed to save user choice', 500);
        }
    }

    public function reset(ResetUserChoicesRequest $request)
    {
        try {
            $validated = $request->validated();
            UserChoice::where('user_id', $validated['user_id'])->delete();

            return $this->successResponse(
                null,
                'Choices reset successfully'
            );
        } catch (\Exception $e) {
            throw new ApiException('Failed to reset choices', 500);
        }
    }
}