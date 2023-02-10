<footer id="footer" class="footer">
    @php
        $year = \Carbon\Carbon::now()->format('Y')
    @endphp
    <div class="copyright">
        {{$year}} &copy; Copyright <strong><span>DairyReport</span></strong>. All Rights Reserved
    </div>
</footer>
