<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use OpenApi\Annotations as OA;

class CandidateController extends Controller
{

    /**
    * @OA\Get(
    * path="/api/candidate",
    * operationId="CandidateGetAll",
    * tags={"Get All Candidate"},
    * summary="Get All Candidate",
    * security={
    *  {"passport": {}},
    *   },
    * description="Get All Candidate here",
    *      @OA\Response(
    *          response=200,
    *          description="Candidate List",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=500, description="Unauthorised"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function index()
    {
        $candidate = Candidate::all();
        return response()->json([
            "success" => true,
            "message" => "Candidate List",
            "data" => $candidate
        ]);
    }

    /**
    * @OA\Post(
    * path="/api/candidate",
    * operationId="StoreCandidate",
    * tags={"Store Candidate"},
    * summary="Store Candidate",
    * description="Store Candidate here",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"name", "experience", "education", "bod", "last_position", "applied_position", "skills", "email", "phone","resume" },
    *               @OA\Property(property="name", type="text"),
    *               @OA\Property(property="experience", type="number"),
    *               @OA\Property(property="education", type="text"),
    *               @OA\Property(property="bod", type="date"),
    *               @OA\Property(property="last_position", type="text"),
    *               @OA\Property(property="applied_position", type="text"),
    *               @OA\Property(property="skills", type="text"),
    *               @OA\Property(property="email", type="text"),
    *               @OA\Property(property="phone", type="text"),
    *               @OA\Property(property="resume", type="file"),
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Candidate Saved",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=401, description="Unauthorised"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function store(StoreCandidateRequest $request)
    {
        $candidate = Candidate::create($request->all());
        return response()->json([
            "success" => true,
            "message" => "Candidate Saved",
            "data" => $candidate
        ], 201);
    }

    /**
    * @OA\Get(
    * path="/api/candidate/1",
    * operationId="CandidateGetOne",
    * tags={"Get One Candidate"},
    * summary="Get One Candidate",
    * security={
    *  {"passport": {}},
    *   },
    * description="Get One Candidate here",
    *      @OA\Response(
    *          response=200,
    *          description="Candidate List",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=500, description="Unauthorised"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function show(Candidate $candidate)
    {
        return response()->json([
            "success" => true,
            "message" => "Candidate Found",
            "data" => $candidate
        ]);
    }

    /**
    * @OA\Patch(
    * path="/api/candidate/1",
    * operationId="UpdateCandidate",
    * tags={"Update Candidate"},
    * summary="Update Candidate",
    * description="Update Candidate here",
    *     @OA\RequestBody(
    *         @OA\JsonContent(),
    *         @OA\MediaType(
    *            mediaType="multipart/form-data",
    *            @OA\Schema(
    *               type="object",
    *               required={"name", "experience", "education", "bod", "last_position", "applied_position", "skills", "email", "phone","resume" },
    *               @OA\Property(property="name", type="text"),
    *               @OA\Property(property="experience", type="number"),
    *               @OA\Property(property="education", type="text"),
    *               @OA\Property(property="bod", type="date"),
    *               @OA\Property(property="last_position", type="text"),
    *               @OA\Property(property="applied_position", type="text"),
    *               @OA\Property(property="skills", type="text"),
    *               @OA\Property(property="email", type="text"),
    *               @OA\Property(property="phone", type="text"),
    *               @OA\Property(property="resume", type="file"),
    *            ),
    *        ),
    *    ),
    *      @OA\Response(
    *          response=201,
    *          description="Candidate Saved",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=401, description="Unauthorised"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        $candidate->update($request->all());
        return response()->json([
            "success" => true,
            "message" => "Candidate Updated",
            "data" => $candidate
        ]);
    }

    /**
    * @OA\Delete(
    * path="/api/candidate/1",
    * operationId="CandidateDeleteOne",
    * tags={"Delete One Candidate"},
    * summary="Delete One Candidate",
    * security={
    *  {"passport": {}},
    *   },
    * description="Delete One Candidate here",
    *      @OA\Response(
    *          response=200,
    *          description="Candidate Deleted",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(response=500, description="Unauthorised"),
    *      @OA\Response(response=404, description="Resource Not Found"),
    * )
    */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return response()->json([
            "success" => true,
            "message" => "Candidate Deleted",
            "data" => $candidate
        ]);
    }
}
