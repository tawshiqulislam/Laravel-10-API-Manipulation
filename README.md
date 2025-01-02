web.php >
-----------------------------
// Route to get access token
// Route::get('/get-access-token', [ApiController::class, 'getAccessToken']);

// Route to get access token
// Route::get('/get-grant-token', [ApiController::class, 'generateGrantToken']);

// Route to refresh token
// Route::get('/refresh-token', [ApiController::class, 'refreshToken']);

// Route to get question
Route::get('/get-question', [ApiController::class, 'getQuestion']);

ApiController.php >
-----------------------------


    public function getAccessToken(Request $request){
        $email = 'xxxxxxxxx@gmail.com'; // verified Email
        $data = $this->apiService->getAccessToken($email);

        Session::put('access_token', $data['accessToken']);

        return response()->json($data);
    }

    public function generateGrantToken(Request $request){
        $access_token = Session::get('access_token');
        $data = $this->apiService->grantToken($access_token);
        
        Session::put('grant_token', $data['grantToken']);

        return response()->json($data);
    }

    public function refreshToken(Request $request){
        $accessToken = Session::get('access_token');
        $grantToken = Session::get('grant_token');

        $data = $this->apiService->refreshToken($accessToken, $grantToken);

        Session::put('grant_token', $data['grantToken']);

        return response()->json($data);
    }

    public function getQuestion(Request $request)
    {
        $this->getAccessToken($request);
        $this->generateGrantToken($request);
        $accessToken = Session::get('access_token');
        $grantToken = Session::get('grant_token');

        if (isset($accessToken) && isset($grantToken)) {
            $data = $this->apiService->getQuestion($accessToken, $grantToken);
        } else {
            $this->refreshToken($request);
            $data = $this->apiService->getQuestion($accessToken, $grantToken);
        }

        // Call the getSortedData function and return its result
        $sortedData = $this->getSortedData($request);

        return response()->json([
            'question' => $data['question'],
            'sortedData' => $sortedData,
        ]);
    }

    public function getSortedData(Request $request)
    {
        $this->getAccessToken($request);
        $this->generateGrantToken($request);
        $accessToken = Session::get('access_token');
        $grantToken = Session::get('grant_token');

        if (isset($accessToken) && isset($grantToken)) {
            $data = $this->apiService->getQuestion($accessToken, $grantToken);
        } else {
            $this->refreshToken($request);
            $data = $this->apiService->getQuestion($accessToken, $grantToken);
        }

        $sortedData = new ProductResource($data['solutionResult']);

        return response()->json($sortedData);
    }
