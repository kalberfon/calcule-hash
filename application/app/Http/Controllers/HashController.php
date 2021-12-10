<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\HashRepositoryListener;
use App\Contracts\ServiceResponse\GenerateHashServiceResponseListener;
use App\Http\Resources\HashCollection;
use App\Http\Resources\HashFullResource;
use App\Http\Resources\HashResource;
use App\Models\Hash;
use App\Repositories\HashRepository;
use App\Services\GenerateHashService;
use Illuminate\Http\Request;

/**
 * Class HashController
 * @package App\Http\Controllers
 */
class HashController extends Controller implements  GenerateHashServiceResponseListener
{
    /**
     * @var HashRepository
     */
    private $repository;

    /**
     * HashController constructor.
     * @param HashRepositoryListener $repository
     */
    public function __construct(HashRepositoryListener $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var Illuminate\Pagination\LengthAwarePaginator $aginate */
        return response()->json(
            new HashCollection(
                $this->repository->paginate($request->get('page') ?? 1, $request->get('filters') ?? [])
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, GenerateHashService $service)
    {
        return $service->handle($this, $this->repository, $request->get('string'));
    }

    /**
     * @param Hash $hash
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function hashSuccessCreated(Hash $hash)
    {
        return response()->json(
            new HashResource($hash),
            201
        );
    }

    /**
     * @param $error
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function hashError($error)
    {
        return response()->json($error);
    }

}
