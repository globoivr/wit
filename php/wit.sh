TOKEN="VRTDGQ45ZEH2K2VTUSWQNCZPWG7LQHHO"

 curl -sS -XPOST 'https://api.wit.ai/speech?v=20141022' \
   -i -L \
   -H "Authorization: Bearer $TOKEN" \
   -H "Content-Type: audio/wav" \
   --data-binary "@/tmp/test.wav"
