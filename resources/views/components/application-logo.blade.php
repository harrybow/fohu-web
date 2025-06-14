<svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <!-- Farbverläufe und Schatten für den gewissen Wow-Effekt -->
    <defs>
      <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="0%" stop-color="#00c6ff"/>
        <stop offset="100%" stop-color="#0072ff"/>
      </linearGradient>
      <linearGradient id="gradient2" x1="0%" y1="0%" x2="0%" y2="100%">
        <stop offset="0%" stop-color="#f2709c"/>
        <stop offset="100%" stop-color="#ff9472"/>
      </linearGradient>
      <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
        <feDropShadow dx="0" dy="2" stdDeviation="2" flood-color="rgba(0,0,0,0.3)"/>
      </filter>
    </defs>

    <!-- FOH mit horizontalem Farbverlauf und Schatten -->
    <text x="10" y="35" textLength="180" font-weight="700" lengthAdjust="spacingAndGlyphs" font-size="32" fill="url(#gradient1)" font-family="sans-serif" filter="url(#shadow)">FOH</text>

    <!-- ULTRAS leicht schräg gestellt, vertikaler Farbverlauf -->
    <g transform="translate(0,15) skewX(-10)">
      <text x="10" y="70" textLength="180" font-weight="700" lengthAdjust="spacingAndGlyphs" font-size="32" fill="url(#gradient2)" font-family="sans-serif" filter="url(#shadow)">ULTRAS</text>
    </g>
  </svg>
